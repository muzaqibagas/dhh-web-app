<?php

namespace App\Http\Controllers;

use App\Models\SyaratKomprehensifmhs;
use App\Models\Komprehensifmhs;
use App\Models\StaffDept;
use App\Models\User;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SyaratKomprehensifmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listModerator = StaffDept::all();
        $search = $request->input('search');

        $pendaftar = SyaratKomprehensifmhs::with('mahasiswa')
            ->where('status', '!=', 'ditolak') 
            ->where('bap', '!=', 'ditolak')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->get();
        return view('syaratkomprehensifmhs.index', compact('pendaftar', 'listModerator'));
    }

    public function setujui(Request $request, $id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);

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

        return redirect()->back()->with('success', 'Syarat pendaftaran Komprehensif telah disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);

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
        $syarat = SyaratKomprehensifmhs::with(['mahasiswa', 'moderator', 'penguji'])->findOrFail($id);
        $komprehensif = Komprehensifmhs::with([
            'mahasiswa',
            'ruangan',
            'semester',
            'pembimbing1',
            'pembimbing2',
        ])->where('id_mahasiswa', $syarat->id_mahasiswa)->first();

        if (!$komprehensif) {
            return back()->with('error', 'Mahasiswa ini belum melakukan pendaftaran Komprehensif.');
        }

        $template = public_path('undangan/templateundangankomprehensif.pdf');
        $outputPath = public_path('undangan/undangankomprehensif');
        if (!file_exists($outputPath))
            mkdir($outputPath, 0777, true);
        $output = $outputPath . "/{$komprehensif->nim}_undangankomprehensif.pdf";

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Times', '', 12);

        Carbon::setLocale('id');
        $tanggalCarbon = Carbon::parse($komprehensif->tanggal);
        $hari = ucfirst($tanggalCarbon->translatedFormat('l'));
        $tanggal = $tanggalCarbon->translatedFormat('d F Y');
        $mulai = Carbon::parse($komprehensif->waktu_mulai)->format('H.i');
        $selesai = Carbon::parse($komprehensif->waktu_selesai)->format('H.i');

        $tempat = ($komprehensif->tipe_pelaksanaan === 'offline')
            ? ($komprehensif->ruangan->nama ?? '-')
            : ($komprehensif->link_meeting ?? '-');

        $moderator = $syarat->moderator->nama ?? '-';
        $penguji = $syarat->penguji->nama ?? '-';

        $pdf->SetXY(99,71.5);
        $pdf->MultiCell(86, 5, $komprehensif->pembimbing1->nama ?? '-', 0, 'L');

        
        $pdf->SetXY(99,76.5);
        $pdf->MultiCell(86, 5, $komprehensif->pembimbing2->nama ?? '-', 0, 'L');

        $pdf->SetXY(99,91);
        $pdf->MultiCell(86, 5.5, $penguji, 0, 'L');

        $pdf->SetXY(99,96);
        $pdf->MultiCell(86, 5.5, $moderator, 0, 'L');

        $pdf->SetXY(79,129.3);
        $pdf->MultiCell(106, 5.5, $komprehensif->mahasiswa->nama ?? '-', 0, 'L');

        $pdf->SetXY(79,137);
        $pdf->MultiCell(106, 5.5, $komprehensif->nim ?? '-', 0, 'L');

        $pdf->SetXY(79,142);
        $pdf->MultiCell(106, 5.5, $komprehensif->judul_tugasakhir, 0, 'L');
        
        $pdf->SetXY(79,160.3);
        $pdf->MultiCell(106, 5.5, "{$hari} / {$tanggal}", 0, 'L');
        
        $pdf->SetXY(79,168);
        $pdf->MultiCell(106, 5.5, "{$mulai} - {$selesai} WIB", 0, 'L');
        
        $pdf->SetXY(79,176);
        $pdf->MultiCell(106, 5.5, $tempat, 0, 'L');

        $pdf->SetXY(126, 206.5);
        $pdf->MultiCell(58, 5.5, now()->translatedFormat('d F Y'), 0, 'L');

        $pdf->Output($output, 'F');
        return response()->download($output);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswaId = auth()->id();

        $komprehensif = Komprehensifmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if (!$komprehensif){
            return redirect()
            ->route('komprehensifmhs.create')
            ->with('error', 'Anda belum mendaftar Komprehensif. Silakan daftar terlebih dahulu sebelum mengisi persyaratan.');
        }

        $syarat = SyaratKomprehensifmhs::where('id_mahasiswa', $mahasiswaId)->first();        
        return view('syaratkomprehensifmhs.create', compact('syarat')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();

        $existing = SyaratKomprehensifmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($existing && $existing->status === 'disetujui') {
            return redirect()->back()->with('error', 'Anda sudah memiliki pendaftaran yang disetujui. Tidak dapat mengajukan lagi.');
        }

        if ($existing && $existing->bap === 'ditolak' && !$request->hasFile('formulir') ) {
            return redirect()->back()->with('error', 'Silakan unggah ulang formulir, anda belum melaksanakan seminar hasil.');
        }

        $data = $request->validate([
            'formulir' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_sks' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_spp' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_kehadiran' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'id_mahasiswa' => $mahasiswaId,
            'status' => 'pending',
            'bap' => 'belum_melaksanakan',
        ];

        $user = auth()->user();
        $folderName = $user->nama . '_' . $user->nim;

        $destinationPath = public_path('syarat_komprehensif/' . $folderName);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $nim = $user->nim;
        if ($request->hasFile('formulir')) {
            $formulir = $request->file('formulir');
            $formulirName = 'formulir_komprehensif_' . $nim . '.' . $formulir->getClientOriginalExtension();
            $formulir->move($destinationPath, $formulirName);
            $data['formulir'] = 'syarat_komprehensif/' . $folderName . '/' . $formulirName;
        }

        if ($request->hasFile('bukti_sks')) {
            $buktiSks = $request->file('bukti_sks');
            $buktiSksName = 'bukti_sks_' . $nim . '.' . $buktiSks->getClientOriginalExtension();
            $buktiSks->move($destinationPath, $buktiSksName);
            $data['bukti_sks'] = 'syarat_komprehensif/' . $folderName . '/' . $buktiSksName;
        }

        if ($request->hasFile('bukti_spp')) {
            $buktiSpp = $request->file('bukti_spp');
            $buktiSppName = 'bukti_spp_' . $nim . '.' . $buktiSpp->getClientOriginalExtension();
            $buktiSpp->move($destinationPath, $buktiSppName);
            $data['bukti_spp'] = 'syarat_komprehensif/' . $folderName . '/' . $buktiSppName;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $buktiKehadiran = $request->file('bukti_kehadiran');
            $buktiKehadiranName = 'bukti_kehadiran_' . $nim . '.' . $buktiKehadiran->getClientOriginalExtension();
            $buktiKehadiran->move($destinationPath, $buktiKehadiranName);
            $data['bukti_kehadiran'] = 'syarat_komprehensif/' . $folderName . '/' . $buktiKehadiranName;
        }

        SyaratKomprehensifmhs::create($data);        

        return redirect()->back()->with('success', 'Berkas pendaftaran komprehensif berhasil diajukan dan sedang menunggu persetujuan.');        
    }

    public function reupload(Request $request, $id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);
        $user = auth()->user();
        $nim = $user->nim;
        $folderName = $user->nama . '_' . $user->nim;
        $destinationPath = public_path('syarat_komprehensif/' . $folderName);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }   

        if ($request->hasfile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_komprehensif_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->formulir = 'syarat_komprehensif/' . $folderName . '/' . $fileName;            
            $syarat->alasan_formulir = null;            
        }

        if ($request->hasfile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_sks = 'syarat_komprehensif/' . $folderName . '/' . $fileName;            
            $syarat->alasan_bukti_sks = null;            
        }

        if ($request->hasfile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_spp = 'syarat_komprehensif/' . $folderName . '/' . $fileName;            
            $syarat->alasan_bukti_spp = null;            
        }

        if ($request->hasfile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_kehadiran = 'syarat_komprehensif/' . $folderName . '/' . $fileName;            
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

        return redirect()->back()->with('success', 'Berkas pendaftaran komprehensif berhasil diunggah ulang dan sedang menunggu persetujuan.');
    }

    public function bapDiterima(Request $request, $id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);

        $syarat->update([
            'status' => 'disetujui',
            'bap' => 'diterima',
        ]);

        return redirect()->back()->with('success', 'BAP Komprehensif telah diterima.');
    }

    public function bapDitolak(Request $request, $id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);

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

        return redirect()->back()->with('error', 'BAP belum diterima. Mahasiswa Harus mengunggah ulang persyaratan komprehenensif.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        $nim = $syaratKomprehensifmhs->mahasiswa->nim;
        $listModerator = StaffDept::all();
        $penguji = StaffDept::all();

        $formulirPath = $syaratKomprehensifmhs->formulir;
        $ext = pathinfo($formulirPath, PATHINFO_EXTENSION);

        return view('syaratkomprehensifmhs.moderator', compact('syaratKomprehensifmhs', 'listModerator', 'penguji', 'nim', 'formulirPath', 'ext'));
    }

    public function tambahModerator(Request $request, SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        $request->validate([
            'moderator' => 'required|string|max:255',
            'penguji' => 'required|string|max:255'
        ]);

        $nim = $syaratKomprehensifmhs->mahasiswa->nim;        
        $nama = $syaratKomprehensifmhs->mahasiswa->nama;        
        $moderatorId = $request->moderator;
        $pengujiId = $request->penguji;

        $moderator = StaffDept::findOrFail($moderatorId)->nama;
        $penguji = StaffDept::findOrFail($pengujiId)->nama;

        $syaratKomprehensifmhs->update([
            'id_moderator' => $moderatorId,
            'id_penguji' => $pengujiId
        ]); 
                
        return redirect()->back()->with('success', "Ketua Sidang <strong>{$moderator}</strong> dan Dosen Penguji <strong>{$penguji}</strong> berhasil ditambahkan untuk mahasiswa <strong>{$nama}</strong> (<strong>{$nim}</strong>).");
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        //
    }
}
