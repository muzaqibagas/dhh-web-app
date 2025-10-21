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
    public function index()
    {
        $listModerator = StaffDept::all();
        $pendaftar = SyaratKomprehensifmhs::with('mahasiswa')
            ->where('status', '!=', 'ditolak') 
            ->get();
        return view('syaratkomprehensifmhs.index', compact('pendaftar', 'listModerator'));
    }

    public function setujui($id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);
        $syarat->update(['status' => 'disetujui']);

        return redirect()->back()->with('success', 'Pendaftaran disetujui.');
    }

    public function tolak($id)
    {
        $syarat = SyaratKomprehensifmhs::findOrFail($id);

        $user = $syarat->mahasiswa; // pastikan relasi mahasiswa() ada
        $folderName = $user->nama . '_' . $user->nim;
        $folderPath = public_path('syarat_komprehensif/' . $folderName);

        // hapus folder beserta isinya
        if (\File::exists($folderPath)) {
            \File::deleteDirectory($folderPath);
        }

        // update status jadi ditolak
        $syarat->update(['status' => 'ditolak']);

        return back()->with('success', 'Syarat ditolak dan semua file dihapus.');
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

        $data = $request->validate([
            'formulir' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_sks' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_spp' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_kehadiran' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'id_mahasiswa' => $mahasiswaId,
            'status' => 'pending',
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
            $formulirName = 'formulir_' . $nim . '_' . Str::random(10) . '.' . $formulir->getClientOriginalExtension();
            $formulir->move($destinationPath, $formulirName);
            $data['formulir'] = 'syarat_komprehensif/' . $folderName . '/' . $formulirName;
        }

        if ($request->hasFile('bukti_sks')) {
            $buktiSks = $request->file('bukti_sks');
            $buktiSksName = 'bukti_sks_' . $nim . '_' . Str::random(10) . '.' . $buktiSks->getClientOriginalExtension();
            $buktiSks->move($destinationPath, $buktiSksName);
            $data['bukti_sks'] = 'syarat_komprehensif/' . $folderName . '/' . $buktiSksName;
        }

        if ($request->hasFile('bukti_spp')) {
            $buktiSpp = $request->file('bukti_spp');
            $buktiSppName = 'bukti_spp_' . $nim . '_' . Str::random(10) . '.' . $buktiSpp->getClientOriginalExtension();
            $buktiSpp->move($destinationPath, $buktiSppName);
            $data['bukti_spp'] = 'syarat_komprehensif/' . $folderName . '/' . $buktiSppName;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $buktiKehadiran = $request->file('bukti_kehadiran');
            $buktiKehadiranName = 'bukti_kehadiran_' . $nim . '_' . Str::random(10) . '.' . $buktiKehadiran->getClientOriginalExtension();
            $buktiKehadiran->move($destinationPath, $buktiKehadiranName);
            $data['bukti_kehadiran'] = 'syarat_komprehensif/' . $folderName . '/' . $buktiKehadiranName;
        }

        $insert = SyaratKomprehensifmhs::create($data);
        if ($insert) {
            return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diajukan dan sedang menunggu persetujuan.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengajukan berkas pendaftaran seminar.');
        }
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
        
        return redirect()->back()->with('success', "Moderator {$moderator} dan Penguji {$penguji} berhasil ditambahkan untuk mahasiswa {$nama} ({$nim}).");
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
