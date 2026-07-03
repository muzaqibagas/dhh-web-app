<?php

namespace App\Http\Controllers;

use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Notification as AppNotification;
use App\Models\Seminarmhs;
use App\Models\StaffDept;
use App\Models\StaffNotification;
use App\Models\SyaratUjian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class SyaratUjianController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->jenis ?? 'kolokium';
        $search = $request->search;

        $data = SyaratUjian::with('mahasiswa')
            ->when($jenis, fn ($q) => $q->where('jenis_ujian', $jenis))
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%$search%")
                        ->orWhere('nim', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10);

        $listModerator = StaffDept::all();

        return view('syaratujian.index', compact('data', 'listModerator', 'jenis'));
    }

    public function setujui(Request $request, $id)
    {
        $data = SyaratUjian::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_makalah' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $data->update([
            'status' => 'disetujui',
            'alasan_formulir' => null,
            'alasan_makalah' => null,
            'alasan_bukti_sks' => null,
            'alasan_bukti_spp' => null,
            'alasan_bukti_kehadiran' => null,
        ]);

        $this->sendNotification(
            $data->id_mahasiswa,
            '🔔 Berkas Disetujui',
            "Berkas persyaratan {$data->jenis_ujian} disetujui.",
            route('syaratujian.create', ['jenis' => $data->jenis_ujian])
        );

        return back()->with('success', 'Syarat pendaftaran telah disetujui');
    }

    public function tolak(Request $request, $id)
    {
        $data = SyaratUjian::findOrFail($id);

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
            return back()->with('error', 'Minimal 1 alasan penolakan harus diisi');
        }

        $data->update([
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

        $reasonMessage = "⚠️ Berkas persyaratan {$data->jenis_ujian} anda perlu diperbaiki:</br><ul>";
        foreach ($reasons as $key => $reason) {
            if ($reason) {
                $reasonMessage .= "<li><strong>$key:</strong> $reason</li>";
            }
        }
        $reasonMessage .= '</ul>';

        $this->sendNotification(
            $data->id_mahasiswa,
            '🔔 Berkas Ditolak',
            $reasonMessage,
            route('syaratujian.create', ['jenis' => $data->jenis_ujian])
        );

        return back()->with('error', 'Syarat pendaftaran telah ditolak');
    }

    public function downloadPdf($id)
    {
        $syarat = SyaratUjian::with(['mahasiswa', 'moderator', 'penandatanganundangan'])
            ->findOrFail($id);

        $jenis = $syarat->jenis_ujian;

        $ujian = match ($jenis) {
            'kolokium' => Kolokiummhs::where('id_mahasiswa', $syarat->id_mahasiswa)->first(),
            'seminar' => Seminarmhs::where('id_mahasiswa', $syarat->id_mahasiswa)->first(),
            'komprehensif' => Komprehensifmhs::where('id_mahasiswa', $syarat->id_mahasiswa)->first(),
        };

        if (! $ujian) {
            return back()->with('error', 'Data ujian tidak ditemukan');
        }

        $template = match ($jenis) {
            'kolokium' => public_path('undangan/template_kolokium.pdf'),
            'seminar' => public_path('undangan/template_seminar.pdf'),
            'komprehensif' => public_path('undangan/template_komprehensif.pdf'),
        };

        $outputPath = public_path("undangan/output/$jenis");
        if (! file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }

        $output = $outputPath."/{$ujian->nim}_{$jenis}.pdf";

        $pdf = new Fpdi;
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);

        $pdf->SetFont('Times', '', 12);

        Carbon::setLocale('id');
        $tanggalCarbon = Carbon::parse($ujian->tanggal);

        $hari = ucfirst($tanggalCarbon->translatedFormat('l'));
        $tanggal = $tanggalCarbon->translatedFormat('d F Y');

        $mulai = Carbon::parse($ujian->waktu_mulai)->format('H.i');
        $selesai = Carbon::parse($ujian->waktu_selesai)->format('H.i');

        $tempat = ($ujian->tipe_pelaksanaan === 'offline')
            ? ($ujian->ruangan->nama ?? '-')
            : ($ujian->link_meeting ?? '-');

        $pdf->SetXY(23, 105);
        $pdf->MultiCell(32, 6, "{$ujian->mahasiswa->nama} / {$ujian->nim}", 0, 'L');

        $pdf->SetXY(59, 105);
        $pdf->MultiCell(32, 6, "{$hari} /\n{$tanggal}", 0, 'L');

        $pdf->SetXY(95, 105);
        $pdf->MultiCell(32, 6, "{$mulai} - {$selesai} WIB /\n{$tempat}", 0, 'L');

        $pdf->SetXY(131, 105);
        $pdf->MultiCell(65, 6, $ujian->judul ?? $ujian->judul_kolokium ?? '-', 0, 'L');

        if ($jenis === 'kolokium' || $jenis === 'seminar') {
            $pdf->SetXY(131, 145);
            $pdf->MultiCell(65, 6, $ujian->pembimbing1->nama ?? '-', 0, 'L');

            $pdf->SetXY(131, 163);
            $pdf->MultiCell(65, 6, $ujian->pembimbing2->nama ?? '-', 0, 'L');
        }

        if ($jenis === 'komprehensif') {
            $pdf->SetXY(131, 145);
            $pdf->MultiCell(65, 6, $ujian->penguji->nama ?? '-', 0, 'L');
        }

        // moderator
        $pdf->SetXY(131, 183);
        $pdf->MultiCell(65, 6, $syarat->moderator->nama ?? '-', 0, 'L');

        // tanda tangan
        $pdf->SetXY(113, 243);
        $pdf->MultiCell(85, 6, $syarat->penandatanganundangan->nama ?? '-', 0, 'L');

        $pdf->Output($output, 'F');

        return response()->download($output);
    }

    public function create(Request $request)
    {
        $jenis = $request->jenis;
        $mahasiswaId = auth()->id();

        // validasi sudah daftar ujian
        $exists = match ($jenis) {
            'kolokium' => Kolokiummhs::where('id_mahasiswa', $mahasiswaId)->exists(),
            'seminar' => Seminarmhs::where('id_mahasiswa', $mahasiswaId)->exists(),
            'komprehensif' => Komprehensifmhs::where('id_mahasiswa', $mahasiswaId)->exists(),
        };

        if (! $exists) {
            $route = match ($jenis) {
                'kolokium' => 'kolokiummhs.create',
                'seminar' => 'seminarmhs.create',
                'komprehensif' => 'komprehensifmhs.create',
                default => 'dashboardmhs.index'
            };

            return redirect()
                ->route($route)
                ->with('error', 'Silakan daftar ujian terlebih dahulu');
        }

        $syarat = SyaratUjian::where('id_mahasiswa', $mahasiswaId)
            ->where('jenis_ujian', $jenis)
            ->first();

        return view('syaratujian.create', compact('jenis', 'syarat'));
    }

    public function store(Request $request)
    {
        $jenis = $request->jenis_ujian;
        $mahasiswaId = auth()->id();

        $existing = SyaratUjian::where('id_mahasiswa', $mahasiswaId)
            ->where('jenis_ujian', $jenis)
            ->first();

        if ($existing && $existing->status === 'disetujui') {
            return back()->with('error', 'Anda sudah memiliki pendaftaran yang disetujui.');
        }

        if ($existing && $existing->bap === 'ditolak' && ! $request->hasFile('formulir')) {
            return back()->with('error', 'Silakan unggah ulang formulir, anda belum melaksanakan ujian.');
        }

        $request->validate([
            'formulir' => 'required|mimes:pdf|max:10240',
            'makalah' => 'required|mimes:pdf|max:10240',
            'bukti_sks' => 'required|mimes:pdf|max:10240',
            'bukti_spp' => 'required|mimes:pdf|max:10240',
            'bukti_kehadiran' => 'required|mimes:pdf|max:10240',
        ]);

        $user = auth()->user();
        $nim = $user->nim;
        $folderName = $user->nama.'_'.$user->nim;

        // 🔥 beda tiap jenis ujian
        $basePath = "syarat_$jenis";
        $destinationPath = public_path("$basePath/$folderName");

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $data = [
            'id_mahasiswa' => $mahasiswaId,
            'jenis_ujian' => $jenis,
            'status' => 'pending',
            'bap' => 'belum_melaksanakan',
        ];

        // 🔥 upload file satu-satu (seperti kolokium lama)
        $fields = ['formulir', 'makalah', 'bukti_sks', 'bukti_spp', 'bukti_kehadiran'];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                $fileName = "{$field}_{$jenis}_{$nim}.".$file->getClientOriginalExtension();

                $file->move($destinationPath, $fileName);

                $data[$field] = "$basePath/$folderName/$fileName";
            }
        }

        SyaratUjian::updateOrCreate(
            [
                'id_mahasiswa' => $mahasiswaId,
                'jenis_ujian' => $jenis,
            ],
            $data
        );

        $this->sendNotification(
            $mahasiswaId,
            '🔔 Berkas Diajukan',
            "Berkas persyaratan $jenis berhasil diunggah dan menunggu verifikasi.",
            route('syaratujian.create', ['jenis' => $jenis])
        );

        return back()->with('success', 'Berkas berhasil diupload.');
    }

    public function reupload(Request $request, $id)
    {
        $data = SyaratUjian::findOrFail($id);
        $jenis = $data->jenis_ujian;
        $user = $data->mahasiswa;
        $nim = $user->nim;
        $folderName = $user->nama.'_'.$nim;

        // Gunakan path yang sama seperti store()
        $basePath = "syarat_$jenis";
        $destinationPath = public_path("$basePath/$folderName");

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        foreach (['formulir', 'makalah', 'bukti_sks', 'bukti_spp', 'bukti_kehadiran'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = "{$field}_{$jenis}_{$nim}.".$file->getClientOriginalExtension();

                $file->move($destinationPath, $fileName);

                $data->$field = "$basePath/$folderName/$fileName";
                $data->{'alasan_'.$field} = null;
            }
        }

        $data->status = 'pending';
        $data->bap = 'belum_melaksanakan';
        $data->save();

        return back()->with('success', 'Reupload berhasil');
    }

    public function bapDiterima(Request $request, $id)
    {
        $data = SyaratUjian::findOrFail($id);

        $data->update([
            'status' => 'disetujui',
            'bap' => 'diterima',
        ]);

        $this->sendNotification(
            $data->id_mahasiswa,
            '🎉 BAP Diterima',
            "Selamat Anda sudah melaksanakan Seminar Hasil, BAP untuk ujian {$data->jenis_ujian} anda telah diterima. silakan lanjut ke Ujian Komprehensif.",
            route('syaratujian.create', ['jenis' => $data->jenis_ujian])
        );

        return back()->with('success', "BAP untuk ujian {$data->jenis_ujian} telah diterima");
    }

    public function bapDitolak(Request $request, $id)
    {
        $data = SyaratUjian::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_makalah' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $data->update([
            'status' => 'ditolak',
            'bap' => 'ditolak',
            'alasan_formulir' => "Anda belum melaksanakan {$data->jenis_ujian}, silahkan upload ulang formulir dengan jadwal baru",
            'alasan_makalah' => "Anda belum melaksanakan {$data->jenis_ujian}, silahkan upload ulang makalah",
            'alasan_bukti_sks' => "Anda belum melaksanakan {$data->jenis_ujian}, silahkan upload ulang transkrip nilai",
            'alasan_bukti_spp' => "Anda belum melaksanakan {$data->jenis_ujian}, silahkan upload ulang bukti spp",
            'alasan_bukti_kehadiran' => "Anda belum melaksanakan {$data->jenis_ujian}, silahkan upload ulang bukti kehadiran",
        ]);

        $this->sendNotification(
            $data->id_mahasiswa,
            '🔔 Anda belum melaksanakan Seminar Hasil',
            "Silakan unggah ulang persyaratan {$data->jenis_ujian} dengan jadwal baru.",
            route('syaratujian.create', ['jenis' => $data->jenis_ujian])
        );

        return back()->with('error', "BAP untuk ujian {$data->jenis_ujian} belum diterima. Mahasiswa Harus mengunggah ulang persyaratan seminar hasil");
    }

    public function show(SyaratUjian $syaratUjian)
    {
        $nim = $syaratUjian->mahasiswa?->nim ?? '-';
        $listModerator = StaffDept::all();
        $penguji = StaffDept::all();

        $formulirPath = $syaratUjian->formulir;
        $ext = pathinfo($formulirPath, PATHINFO_EXTENSION);

        return view('syaratujian.show', compact('syaratUjian', 'nim', 'formulirPath', 'ext', 'listModerator', 'penguji'));
    }

    public function tambahModerator(Request $request, SyaratUjian $syaratUjian)
    {
        $rules = [
            'moderator' => 'required|numeric|exists:staff_depts,id',
            'penandatanganundangan' => 'required|numeric|exists:staff_depts,id',
        ];

        // Penguji dan ruangan hanya diperlukan untuk komprehensif
        if ($syaratUjian->jenis_ujian === 'komprehensif') {
            $rules['penguji'] = 'required|numeric|exists:staff_depts,id';
            $rules['ruangan'] = 'required|string|max:255';
        } else {
            $rules['penguji'] = 'nullable|numeric|exists:staff_depts,id';
            $rules['ruangan'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        $nim = $syaratUjian->mahasiswa?->nim ?? '-';
        $nama = $syaratUjian->mahasiswa?->nama ?? '-';
        $moderatorId = $request->moderator;
        $pengujiId = $request->penguji;
        $penandatanganundanganId = $request->penandatanganundangan;

        $moderator = StaffDept::find($moderatorId)->nama;
        $penguji = $pengujiId ? StaffDept::find($pengujiId)->nama : null;
        $penandatanganundangan = StaffDept::find($penandatanganundanganId)->nama;

        $roleKetua = $syaratUjian->jenis_ujian === 'komprehensif'
            ? 'Ketua Sidang'
            : 'Moderator';

        $jenisLabel = ucfirst($syaratUjian->jenis_ujian);

        $syaratUjian->update([
            'id_moderator' => $moderatorId,
            'id_penandatanganundangan' => $penandatanganundanganId,
            'id_penguji' => $pengujiId,
            'ruangan' => $request->ruangan,
        ]);

        $this->sendNotification($syaratUjian->id_mahasiswa,
            "🔔 {$roleKetua} Ditambahkan",
            "{$roleKetua} untuk ujian {$jenisLabel} anda adalah {$moderator}"
            .($penguji ? " dan penguji adalah {$penguji}" : '').".<br> Ruangan Pelaksanaan: <strong>{$request->ruangan}</strong>",
            route('kolokiummhs.show', $syaratUjian->id)
        );

        $this->sendStaffNotification(
            $moderatorId,
            "📢 Anda Ditunjuk Sebagai {$roleKetua}",
            "Anda telah ditunjuk sebagai {$roleKetua} untuk ujian {$jenisLabel} mahasiswa {$nama} ({$nim}).",
            route('staff-notification.resolve', ['syaratUjian' => $syaratUjian->id, 'staffId' => $moderatorId])
        );

        if ($pengujiId) {
            $this->sendStaffNotification(
                $pengujiId,
                '📢 Anda Ditunjuk Sebagai Penguji',
                "Anda telah ditunjuk sebagai penguji untuk ujian {$jenisLabel} mahasiswa {$nama} ({$nim}).",
                route('staff-notification.resolve', ['syaratUjian' => $syaratUjian->id, 'staffId' => $pengujiId])
            );
        }

        return back()->with('success', "{$roleKetua} <strong>{$moderator}</strong> berhasil ditambahkan"
            .($penguji ? " dan penguji <strong>{$penguji}</strong>" : '')
            ." untuk mahasiswa <strong>{$nama}</strong> (<strong>{$nim}</strong>)."
        );
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
