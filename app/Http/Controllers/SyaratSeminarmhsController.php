<?php

namespace App\Http\Controllers;

use App\Models\SyaratSeminarmhs;
use App\Models\Seminarmhs;
use App\Models\StaffDept;
use App\Models\User;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SyaratSeminarmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listModerator = StaffDept::all();
        $pendaftar = SyaratSeminarmhs::with('mahasiswa')
            ->where('status', '!=', 'ditolak') 
            ->where('bap', '!=', 'ditolak')
            ->get();
        return view('syaratseminarmhs.index', compact('pendaftar', 'listModerator'));
    }

    public function setujui(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $syarat->update([
            'status' => 'disetujui',
            'alasan_formulir' => null,
            'alasan_bukti_sks' => null,
            'alasan_bukti_spp' => null,
            'alasan_bukti_kehadiran' => null,
        ]);

        return redirect()->back()->with('success', 'Syarat pendaftaran Seminar Hasil telah disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);
        
        $syarat->update([
            'status' => 'ditolak',
            'alasan_formulir' => $request->alasan_formulir,
            'alasan_bukti_sks' => $request->alasan_bukti_sks,
            'alasan_bukti_spp' => $request->alasan_bukti_spp,            
            'alasan_bukti_kehadiran' => $request->alasan_bukti_kehadiran,
        ]);
        
        return redirect()->back()->with('success', 'Syarat Seminar Hasil ditolak. Alasan penolakan telah disimpan.');
    }

    public function downloadPdf($id)
    {
        $syarat = SyaratSeminarmhs::with(['mahasiswa', 'moderator'])->findOrFail($id);
        $seminar = seminarmhs:: with([
            'mahasiswa', 
            'ruangan',
            'semester',
            'Pembimbing1', 
            'Pembimbing2',
        ])->where('id_mahasiswa', $syarat->id_mahasiswa)->first();

        if (!$seminar) {
            return redirect()->back()->with('error', 'Mahasiswa ini belum melakukan pendaftaran Seminar.');
        }

        $template = public_path('undangan/templateundanganseminar.pdf');
        $outputPath = public_path('undangan/undanganseminar');
        if (!file_exists($outputPath)) 
            mkdir($outputPath, 0777, true);
        $ouput = $outputPath . "/{$seminar->nim}_undanganseminar.pdf";  

        $pdf = new Fpdi();
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
            ? ($seminar->ruangan?->nama_ruangan ?? '-')
            : ($seminar->link_meeting ?? '-');

        $moderator = $syarat->moderator?->nama ?? '-';

        $pdf->SetXY(23, 105);
        $pdf->MultiCell(32, 6, "{$seminar->mahasiswa->nama} / {$seminar->nim}", 0, 'L');

        $pdf->SetXY(59, 105);
        $pdf->MultiCell(32, 6, "{$hari} /\n{$tanggal}", 0, 'L');

        $pdf->SetXY(95, 105);
        $pdf->MultiCell(32, 6, "{$mulai} - {$selesai} WIB /\n{$tempat}", 0, 'L');

        $pdf->SetXY(131, 105);
        $pdf->MultiCell(65, 6, $seminar->judul_seminar, 0, 'L');

        $pdf->SetXY(131, 130);
        $pdf->MultiCell(65, 6, $seminar->pembimbing1?->nama ?? '-', 0, 'L');  

        $pdf->SetXY(131, 148.8);
        $pdf->MultiCell(65, 6, $seminar->pembimbing2?->nama ?? '-', 0, 'L');

        $pdf->SetXY(131, 168.3);
        $pdf->MultiCell(65, 6, $moderator, 0, 'L');        

        $pdf->SetXY(125, 205);
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
        if (!$seminar) {
            return redirect()
            ->route('seminarmhs.create')
            ->with('error', 'Anda belum mendaftar Seminar Hasil. Silakan daftar terlebih dahulu sebelum mengisi persyaratan.');            
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

        if ($existing && $existing->bap === 'ditolak' && !$request->hasFile('formulir')) {
            return redirect()->back()->with('error', 'Silakan unggah ulang formulir, anda belum melaksanakan kolokium.');
        }

        $data = $request->validate([            
            'formulir' => 'required|mimes:pdf|max:2048',
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
        $folderName = $user->nama . '_' . $user->nim;

        $destinationPath = public_path('syarat_seminar/' . $folderName);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $nim = $user->nim;
        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['formulir'] = 'syarat_seminar/' . $folderName . '/' . $fileName;
        }

        if ($request->hasFile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_sks'] = 'syarat_seminar/' . $folderName . '/' . $fileName;
        }

        if ($request->hasFile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_spp'] = 'syarat_seminar/' . $folderName . '/' . $fileName;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_kehadiran'] = 'syarat_seminar/' . $folderName . '/' . $fileName;
        }

        SyaratSeminarmhs::create($data);

        return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diajukan dan sedang menunggu persetujuan.');
    }

    public function reupload(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);
        $user = auth()->user();
        $nim = $user->nim;
        $folderName = $user->nama . '_' . $user->nim;
        $destinationPath = public_path('syarat_seminar/' . $folderName);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_seminar_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->formulir = 'syarat_seminar/' . $folderName . '/' . $fileName;
            $syarat->alasan_formulir = null;
        }

        if ($request->hasFile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_sks = 'syarat_seminar/' . $folderName . '/' . $fileName;
            $syarat->alasan_bukti_sks = null;
        }

        if ($request->hasFile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_spp = 'syarat_seminar/' . $folderName . '/' . $fileName;
            $syarat->alasan_bukti_spp = null;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_kehadiran = 'syarat_seminar/' . $folderName . '/' . $fileName;
            $syarat->alasan_bukti_kehadiran = null;
        }

        if (
            !$syarat->alasan_formulir &&
            !$syarat->alasan_bukti_sks &&
            !$syarat->alasan_bukti_spp &&
            !$syarat->alasan_bukti_kehadiran
        ) {
            $syarat->status = 'pending';
            $syarat->bap = 'belum_melaksanakan';
        }

        $syarat->save();

        return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diunggah ulang dan sedang menunggu persetujuan.');
    }

    public function bapDiterima(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $syarat->update([
            'status' => 'disetujui',
            'bap' => 'diterima',
        ]);

        return redirect()->back()->with('success', 'BAP Seminar Hasil telah diterima.');
    }

    public function bapDitolak(Request $request, $id)
    {
        $syarat = SyaratSeminarmhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $syarat->update([
            'status' => 'ditolak',
            'bap' => 'ditolak',
            'alasan_formulir' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang formulir dengan jadwal baru',
            'alasan_bukti_sks' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang bukti sks',
            'alasan_bukti_spp' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang bukti spp',
            'alasan_bukti_kehadiran' => 'Anda belum melaksanakan Seminar Hasil, silahkan upload ulang bukti kehadiran',
        ]);

        return redirect()->back()->with('success', 'BAP belum diterima. Mahasiswa Harus mengunggah ulang persyaratan seminar hasil');
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
            'moderator' => 'required|string|max:255'
        ]);

        $nim = $syaratSeminarmhs->mahasiswa->nim;
        $nama = $syaratSeminarmhs->mahasiswa->nama;
        $moderatorId = $request->moderator;

        $moderator = StaffDept::findOrFail($moderatorId)->nama;
        
        $syaratSeminarmhs->update([
            'id_moderator' => $moderatorId
        ]);          
                
        return redirect()->back()->with('success', "Moderator <strong>{$moderator}</strong> berhasil ditambahkan untuk mahasiswa <strong>{$nama}</strong> (<strong>{$nim}</strong>).");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SyaratSeminarmhs $syaratSeminarmhs)
    {
        
    }

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
}
