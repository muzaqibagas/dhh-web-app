<?php

namespace App\Http\Controllers;

use App\Models\Notification as AppNotification;
use App\Models\Seminarmhs;
use App\Models\StaffDept;
use App\Models\StaffNotification;
use App\Models\SyaratSeminarmhs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class SyaratSeminarmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listModerator = StaffDept::all();
        $search = $request->input('search');

        $pendaftar = SyaratSeminarmhs::with('mahasiswa')
            ->where('status', '!=', 'ditolak')
            ->where('bap', '!=', 'ditolak')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('syaratseminarmhs.index', compact('pendaftar', 'listModerator'));
    }

    public function setujui(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_makalah' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $syarat->update([
            'status' => 'disetujui',
            'alasan_formulir' => null,
            'alasan_makalah' => null,
            'alasan_bukti_sks' => null,
            'alasan_bukti_spp' => null,
            'alasan_bukti_kehadiran' => null,
        ]);

        $this->sendNotification(
            $syarat->id_mahasiswa,
            '🔔 Berkas Persayaratan Seminar Hasil Disetujui',
            'Berkas persyaratan Seminar Hasil anda telah disetujui. Selamat melaksanakan Seminar Hasil!',
            route('syaratseminarmhs.create', $syarat->id)
        );

        return redirect()->back()->with('success', 'Syarat pendaftaran Seminar Hasil telah disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_makalah' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        if (
            empty($request->alasan_formulir) &&
            empty($request->alasan_makalah) &&
            empty($request->alasan_bukti_sks) &&
            empty($request->alasan_bukti_spp) &&
            empty($request->alasan_bukti_kehadiran)
        ) {
            return redirect()->back()->with('error', 'Minimal satu alasan penolakan harus diisi.');
        }

        $syarat->update([
            'status' => 'ditolak',
            'alasan_formulir' => $request->alasan_formulir,
            'alasan_makalah' => $request->alasan_makalah,
            'alasan_bukti_sks' => $request->alasan_bukti_sks,
            'alasan_bukti_spp' => $request->alasan_bukti_spp,
            'alasan_bukti_kehadiran' => $request->alasan_bukti_kehadiran,
        ]);

        $reasons = [
            'Formulir' => $request->alasan_formulir,
            'Makalah' => $request->alasan_makalah,
            'Bukti Transkrip Nilai' => $request->alasan_bukti_sks,
            'Bukti SPP' => $request->alasan_bukti_spp,
            'Bukti Kehadiran' => $request->alasan_bukti_kehadiran,
        ];

        $reasonMessage = '⚠️ Berkas persyaratan seminar hasil anda perlu diperbaiki:<br><ul>';
        foreach ($reasons as $field => $msg) {
            if ($msg) {
                $reasonMessage .= "<li><b>{$field}</b>: {$msg}</li>";
            }
        }
        $reasonMessage .= '</ul>';

        $this->sendNotification(
            $syarat->id_mahasiswa,
            '🔔 Perlu Revisi Berkas',
            $reasonMessage,
            route('syaratseminarmhs.create', $syarat->id)
        );

        return redirect()->back()->with('success', 'Syarat Seminar Hasil ditolak. Alasan penolakan telah disimpan.');
    }

    public function downloadPdf($id)
    {
        $syarat = SyaratSeminarmhs::with(['mahasiswa', 'moderator', 'penandatanganundangan'])->findOrFail($id);
        $seminar = Seminarmhs::with([
            'mahasiswa',
            'ruangan',
            'semester',
            'Pembimbing1',
            'Pembimbing2',
        ])->where('id_mahasiswa', $syarat->id_mahasiswa)->first();

        if (! $seminar) {
            return redirect()->back()->with('error', 'Mahasiswa ini belum melakukan pendaftaran Seminar.');
        }

        $template = public_path('undangan/templateundanganseminar.pdf');
        $outputPath = public_path('undangan/undanganseminar');
        if (! file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $ouput = $outputPath."/{$seminar->nim}_undanganseminar.pdf";

        $pdf = new Fpdi;
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Times', '', 12);

        Carbon::setLocale('id');
        $tanggalCarbon = Carbon::parse($seminar->tanggal);
        $hari = ucfirst($tanggalCarbon->translatedFormat('l'));
        $tanggal = $tanggalCarbon->translatedFormat('d F Y');
        $mulai = Carbon::parse($seminar->waktu_mulai)->format('H.i');
        $selesai = Carbon::parse($seminar->waktu_selesai)->format('H.i');

        $tempat = ($seminar->tipe_pelaksanaan === 'offline')
            ? ($seminar->ruangan?->nama ?? '-')
            : ($seminar->link_meeting ?? '-');

        $moderator = $syarat->moderator?->nama ?? '-';
        $penandatanganundangan = $syarat->penandatanganundangan->nama ?? '-';
        $jabatanPenandatangan = $syarat->penandatanganundangan->jabatan ?? '-';
        $nipPenandatangan = $syarat->penandatanganundangan->nip ?? '-';

        $pdf->SetXY(23, 105);
        $pdf->MultiCell(32, 6, "{$seminar->mahasiswa->nama} / {$seminar->nim}", 0, 'L');

        $pdf->SetXY(59, 105);
        $pdf->MultiCell(32, 6, "{$hari} /\n{$tanggal}", 0, 'L');

        $pdf->SetXY(95, 105);
        $pdf->MultiCell(32, 6, "{$mulai} - {$selesai} WIB /\n{$tempat}", 0, 'L');

        $pdf->SetXY(131, 105);
        $pdf->MultiCell(65, 6, $seminar->judul_seminar, 0, 'L');

        $pdf->SetXY(131, 145);
        $pdf->MultiCell(65, 6, $seminar->pembimbing1?->nama ?? '-', 0, 'L');

        $pdf->SetXY(131, 163.8);
        $pdf->MultiCell(65, 6, $seminar->pembimbing2?->nama ?? '-', 0, 'L');

        $pdf->SetXY(131, 183.3);
        $pdf->MultiCell(65, 6, $moderator, 0, 'L');

        $pdf->SetXY(113, 223.5);
        $pdf->MultiCell(85, 6, $jabatanPenandatangan, 0, 'L');

        $pdf->SetXY(113, 243);
        $pdf->MultiCell(85, 6, $penandatanganundangan, 0, 'L');

        $pdf->SetXY(113, 248);
        $pdf->MultiCell(85, 6, "NIP. {$nipPenandatangan}", 0, 'L');

        $pdf->SetXY(125, 219);
        $pdf->Cell(0, 6, now()->translatedFormat('d F Y'), 0, 1, 'L');

        $pdf->Output($ouput, 'F');

        return response()->download($ouput);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswaId = auth()->id();

        $seminar = Seminarmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if (! $seminar) {
            return redirect()
                ->route('seminarmhs.create')
                ->with('error', 'Anda belum mendaftar Seminar Hasil. Silakan daftar terlebih dahulu sebelum mengisi persyaratan seminar hasil.');
        }

        $syarat = SyaratSeminarmhs::where('id_mahasiswa', $mahasiswaId)->first();

        return view('syaratseminarmhs.create', compact('syarat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();

        $existing = SyaratSeminarmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($existing && $existing->status === 'disetujui') {
            return redirect()->back()->with('error', 'Anda sudah memiliki pendaftaran yang disetujui. Tidak dapat mengajukan lagi.');
        }

        if ($existing && $existing->bap === 'ditolak' && ! $request->hasFile('formulir')) {
            return redirect()->back()->with('error', 'Silakan unggah ulang formulir, anda belum melaksanakan kolokium.');
        }

        $data = $request->validate([
            'formulir' => 'required|mimes:pdf|max:2048',
            'makalah' => 'required|mimes:pdf|max:2048',
            'bukti_sks' => 'required|mimes:pdf|max:2048',
            'bukti_spp' => 'required|mimes:pdf|max:2048',
            'bukti_kehadiran' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = [
            'id_mahasiswa' => $mahasiswaId,
            'status' => 'pending',
            'bap' => 'belum_melaksanakan',
        ];

        $user = auth()->user();
        $folderName = $user->nama.'_'.$user->nim;

        $destinationPath = public_path('syarat_seminar/'.$folderName);

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $nim = $user->nim;
        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_seminar_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['formulir'] = 'syarat_seminar/'.$folderName.'/'.$fileName;
        }

        if ($request->hasFile('makalah')) {
            $file = $request->file('makalah');
            $fileName = 'makalah_seminar_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['makalah'] = 'syarat_seminar/'.$folderName.'/'.$fileName;
        }

        if ($request->hasFile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_sks'] = 'syarat_seminar/'.$folderName.'/'.$fileName;
        }

        if ($request->hasFile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_spp'] = 'syarat_seminar/'.$folderName.'/'.$fileName;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_kehadiran'] = 'syarat_seminar/'.$folderName.'/'.$fileName;
        }

        SyaratSeminarmhs::create($data);

        $this->sendNotification($mahasiswaId,
            '🔔 Berkas Seminar Hasil Diajukan',
            'Berkas persyaratan Seminar Hasil berhasil diunggah. Menunggu pengecekan admin.',
            route('syaratseminarmhs.create')
        );

        return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diajukan dan sedang menunggu persetujuan.');
    }

    public function reupload(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);
        $user = auth()->user();
        $nim = $user->nim;
        $folderName = $user->nama.'_'.$user->nim;
        $destinationPath = public_path('syarat_seminar/'.$folderName);

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_seminar_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->formulir = 'syarat_seminar/'.$folderName.'/'.$fileName;
            $syarat->alasan_formulir = null;
        }

        if ($request->hasFile('makalah')) {
            $file = $request->file('makalah');
            $fileName = 'makalah_seminar_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->makalah = 'syarat_seminar/'.$folderName.'/'.$fileName;
            $syarat->alasan_makalah = null;
        }

        if ($request->hasFile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_sks = 'syarat_seminar/'.$folderName.'/'.$fileName;
            $syarat->alasan_bukti_sks = null;
        }

        if ($request->hasFile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_spp = 'syarat_seminar/'.$folderName.'/'.$fileName;
            $syarat->alasan_bukti_spp = null;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_'.$nim.'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_kehadiran = 'syarat_seminar/'.$folderName.'/'.$fileName;
            $syarat->alasan_bukti_kehadiran = null;
        }

        if (
            ! $syarat->alasan_formulir &&
            ! $syarat->alasan_makalah &&
            ! $syarat->alasan_bukti_sks &&
            ! $syarat->alasan_bukti_spp &&
            ! $syarat->alasan_bukti_kehadiran
        ) {
            $syarat->status = 'pending';
            $syarat->bap = 'belum_melaksanakan';
        }

        $syarat->save();

        $this->sendNotification($syarat->id_mahasiswa,
            '🔔 Berkas Persyaratan Seminar Hasil Diunggah Ulang',
            'Berkas perbaikan persyaratan Seminar Hasil berhasil diunggah. Menunggu verifikasi ulang.',
            route('syaratseminarmhs.create')
        );

        return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diunggah ulang dan sedang menunggu persetujuan.');
    }

    public function bapDiterima(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $syarat->update([
            'status' => 'disetujui',
            'bap' => 'diterima',
        ]);

        $this->sendNotification($syarat->id_mahasiswa,
            '🔔 Seminar Hasil Selesai',
            'Selamat Anda sudah melaksanakan Seminar Hasil, silakan lanjut ke Ujian Komprehensif.',
            route('komprehensifmhs.create', $syarat->id)
        );

        return redirect()->back()->with('success', 'BAP Seminar Hasil telah diterima.');
    }

    public function bapDitolak(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_makalah' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $syarat->update([
            'status' => 'ditolak',
            'bap' => 'ditolak',
            'alasan_formulir' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang formulir dengan jadwal baru',
            'alasan_makalah' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang makalah',
            'alasan_bukti_sks' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang transkrip nilai',
            'alasan_bukti_spp' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang bukti spp',
            'alasan_bukti_kehadiran' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang bukti kehadiran',
        ]);

        $this->sendNotification($syarat->id_mahasiswa,
            '🔔 Anda belum melaksanakan Seminar Hasil',
            'Silakan unggah ulang persyaratan seminar hasil dengan jadwal baru.',
            route('syaratseminarmhs.create')
        );

        return redirect()->back()->with('error', 'BAP belum diterima. Mahasiswa Harus mengunggah ulang persyaratan seminar hasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(SyaratSeminarmhs $syaratSeminarmhs)
    {
        $nim = $syaratSeminarmhs->mahasiswa?->nim ?? '-';
        $listModerator = StaffDept::all();

        $formulirPath = $syaratSeminarmhs->formulir;
        $ext = pathinfo($formulirPath, PATHINFO_EXTENSION);

        return view('syaratseminarmhs.moderator', compact('syaratSeminarmhs', 'nim', 'formulirPath', 'ext', 'listModerator'));
    }

    public function tambahModerator(Request $request, SyaratSeminarmhs $syaratSeminarmhs)
    {
        $request->validate([
            'moderator' => 'required|string|max:255',
        ]);

        $nim = $syaratSeminarmhs->mahasiswa->nim;
        $nama = $syaratSeminarmhs->mahasiswa->nama;
        $moderatorId = $request->moderator;
        $penandatanganundanganId = $request->penandatanganundangan;

        $moderator = StaffDept::findOrFail($moderatorId)->nama;
        $penandatanganundangan = StaffDept::findOrFail($penandatanganundanganId)->nama;

        $syaratSeminarmhs->update([
            'id_moderator' => $moderatorId,
            'id_penandatanganundangan' => $penandatanganundanganId,
        ]);

        $this->sendNotification($syaratSeminarmhs->id_mahasiswa,
            '🔔 Moderator Ditentukan',
            "Moderator <strong>{$moderator}</strong> telah ditetapkan untuk seminar hasil Anda.",
            route('seminarmhs.show', $syaratSeminarmhs->seminarmhs->id)
        );

        $this->sendStaffNotification($syaratSeminarmhs->id_moderator,
            '📢 Anda Menjadi Moderator',
            "Anda ditunjuk sebagai moderator untuk seminar hasil mahasiswa {$nama}.",
            route('dashboarddosen.index', $syaratSeminarmhs->seminarmhs->id)
        );

        return redirect()->back()->with('success', "Moderator <strong>{$moderator}</strong> berhasil ditambahkan untuk mahasiswa <strong>{$nama}</strong> (<strong>{$nim}</strong>).");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SyaratSeminarmhs $syaratSeminarmhs) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SyaratSeminarmhs $syaratSeminarmhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SyaratSeminarmhs $syaratSeminarmhs)
    {
        //
    }

    private function sendNotification($userId, $title, $message, $redirect = null)
    {
        AppNotification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'redirect_url' => $redirect,
        ]);
    }

    private function sendStaffNotification($staffId, $title, $message, $redirect = null)
    {
        StaffNotification::create([
            'staff_id' => $staffId,
            'title' => $title,
            'message' => $message,
            'redirect_url' => $redirect,
        ]);
    }
}
