<?php

namespace App\Http\Controllers;

use App\Models\SyaratKolokiummhs;
use App\Models\StaffDept;
use App\Models\User;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Support\Str;


class SyaratKolokiummhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listModerator = StaffDept::all();
        $pendaftar = SyaratKolokiummhs::with('mahasiswa')
            ->where('status', '!=', 'ditolak') // ⬅️ filter supaya yg ditolak tidak tampil
            ->get();
        return view('syaratKolokiummhs.index', compact('pendaftar', 'listModerator'));
    }

    public function setujui($id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);
        $syarat->update(['status' => 'disetujui']);

        return redirect()->back()->with('success', 'Pendaftaran disetujui.');
    }

    public function tolak($id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);

        $user = $syarat->mahasiswa; // pastikan relasi mahasiswa() ada
        $folderName = $user->nama . '_' . $user->nim;
        $folderPath = public_path('syarat_kolokium/' . $folderName);

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
        $syarat = SyaratKolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();        

        return view('syaratKolokiummhs.create', compact('syarat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();

        $existing = SyaratKolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($existing && $existing->status === 'disetujui') {
            return redirect()->back()->with('error', 'Berkas pendaftaran Kolokium Anda sudah disetujui.');
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

        // Ambil data user yang login
        $user = auth()->user(); 
        $folderName = $user->nama . '_' . $user->nim; // contoh: Bagas_12345678

        // Lokasi simpan di public/syarat_kolokium/Nama_NIM/
        $destinationPath = public_path('syarat_kolokium/' . $folderName);

        // Bikin folder kalau belum ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }


        // Simpan file sesuai masing-masing, gunakan NIM sebagai bagian nama file
        $nim = $user->nim;
        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_kolokium_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['formulir'] = 'syarat_kolokium/' . $folderName . '/' . $fileName;
        }

        if ($request->hasFile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_sks'] = 'syarat_kolokium/' . $folderName . '/' . $fileName;
        }

        if ($request->hasFile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_spp'] = 'syarat_kolokium/' . $folderName . '/' . $fileName;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $data['bukti_kehadiran'] = 'syarat_kolokium/' . $folderName . '/' . $fileName;
        }

        SyaratKolokiummhs::create($data);

        return redirect()->back()->with('success', 'Dokumen berhasil diupload!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SyaratKolokiummhs $syaratKolokiummhs)
    {
        $nim = $syaratKolokiummhs->mahasiswa->nim;
        $listModerator = StaffDept::all();
        
        $formulirPath = $syaratKolokiummhs->formulir;
        $ext = pathinfo($formulirPath, PATHINFO_EXTENSION); 

        return view('syaratKolokiummhs.moderator', compact('syaratKolokiummhs', 'nim', 'formulirPath', 'ext', 'listModerator'));
    }


    public function tambahModerator(Request $request, SyaratKolokiummhs $syaratKolokiummhs)
    {
        // Validasi input
        $request->validate([
            'moderator' => 'required|string|max:255'
        ]);

        $nim = $syaratKolokiummhs->mahasiswa->nim;        
        $moderatorId = $request->moderator;

        $moderator = StaffDept::findOrFail($moderatorId)->nama;

        // Simpan ke database
        $syaratKolokiummhs->update([
            'id_moderator' => $moderatorId
        ]);

        // Path file source dan folder output
        $source = public_path($syaratKolokiummhs->formulir);
        $outputDir = public_path("syarat_kolokium/edited");

        // Buat folder jika belum ada
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $outputFile = "formulir_kolokium_{$nim}_final.pdf";
        $outputPath = $outputDir . '/' . $outputFile;

        // Proses PDF
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

        // Simpan file hasil edit
        $pdf->Output('F', $outputPath);        

        // Download file final ke user
        return response()->download($outputPath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SyaratKolokiummhs $syaratKolokiummhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SyaratKolokiummhs $syaratKolokiummhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SyaratKolokiummhs $syaratKolokiummhs)
    {
        //
    }
}
