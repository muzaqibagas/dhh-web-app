<?php

namespace App\Http\Controllers;

use App\Models\SyaratKomprehensifmhs;
use App\Models\StaffDept;
use App\Models\User;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Support\Str;

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

        SyaratKomprehensifmhs::create($data);
        return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diajukan dan sedang menunggu persetujuan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        $nim = $syaratKomprehensifmhs->mahasiswa->nim;
        $listModerator = StaffDept::all();

        $formulirPath = $syaratKomprehensifmhs->formulir;
        $ext = pathinfo($formulirPath, PATHINFO_EXTENSION);

        return view('syaratkomprehensifmhs.moderator', compact('syaratKomprehensifmhs', 'listModerator', 'nim', 'formulirPath', 'ext'));
    }

    public function tambahModerator(Request $request, SyaratKomprehensifmhs $syaratKomprehensifmhs)
    {
        $request->validate([
            'moderator' => 'required|string|max:255'
        ]);

        $nim = $syaratKomprehensifmhs->mahasiswa->nim;        
        $moderatorId = $request->moderator;

        $moderator = StaffDept::findOrFail($moderatorId)->nama;

        $syaratKomprehensifmhs->update([
            'id_moderator' => $moderatorId
        ]);

        $source = public_path($syaratKomprehensifmhs->formulir);
        $outputDir = public_path('Syarat_Komprehensif/edited');

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $outputFile = "formulir_komprehensif_{$nim}_final.pdf";
        $outputPath = $outputDir . '/' . $outputFile;

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($source);

        for ($i = 1; $i <= $pageCount; $i++) {
            $pdf->AddPage();
            $tpl = $pdf->importPage($i);
            $pdf->useTemplate($tpl);

            // Tambahkan nama moderator di halaman terakhir
            if ($i === $pageCount) {
                $pdf->SetFont('Times', '', 12);                

                $pdf->SetXY(80,131); // posisi teks, sesuaikan jika perlu
                $pdf->Write(5, $moderator);
            }
        }

        $pdf->Output('F', $outputPath);        
        
        return response()->download($outputPath);
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
