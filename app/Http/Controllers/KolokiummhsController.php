<?php

namespace App\Http\Controllers;

use App\Models\Kolokiummhs;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\StaffDept;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class KolokiummhsController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $mahasiswaId = auth()->id();
        $kolokiummhs = Kolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($kolokiummhs) {
            // Sudah pernah daftar → lihat detail
            return redirect()->route('kolokiummhs.show', $kolokiummhs->id);
        } else {
            // Belum pernah daftar → tampilkan form
            return redirect()->route('kolokiummhs.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswaId = auth()->id();
        $existing = Kolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();

        if ($existing) {
            return redirect()
                ->route('kolokiummhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar kolokium, silakan edit data yang ada.');
        }

        $kolokiummhs = Kolokiummhs::all();
        $listDosen = StaffDept::all();
        $semesters = Semester::all();
        $ruangans = Ruangan::all();
        return view('kolokiummhs.create', compact('kolokiummhs', 'listDosen', 'semesters', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();
        $existing = Kolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();

        if ($existing) {
            return redirect()
                ->route('kolokiummhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar kolokium, silakan edit data yang ada.');
        }
        
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id',
            'id_semester' => 'required|exists:semesters,id',
            'id_pembimbing1' => 'required|exists:staff_depts,id',              
            'id_pembimbing2' => 'nullable|different:id_pembimbing1|exists:staff_depts,id',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai', 
            'judul_kolokium' => 'required|string|max:255',
        ]);

        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']); 
        $data['alamat'] = Str::title($data['alamat']); 
        $data['judul_kolokium'] = Str::title($data['judul_kolokium']);

        // Hitung hari kerja
        $tanggalKolokium = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();

        $selisihHariKerja = 0;
        $tanggalCek = $hariIni->copy();
        while ($tanggalCek->lt($tanggalKolokium)) {
            if (!$tanggalCek->isWeekend()) {
                $selisihHariKerja++;
            }
            $tanggalCek->addDay();
        }        

        if ($selisihHariKerja < 4) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal kolokium minimal harus lebih dari 4 hari kerja dari hari ini. Harap pilih tanggal lain.');
        }

        if ($tanggalKolokium->isWeekend()) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal kolokium tidak boleh jatuh pada hari Sabtu atau Minggu. Harap pilih hari kerja.');
        }        

        // Simpan ke DB dulu
        $insert = Kolokiummhs::create($data);

        if ($insert) {
            return redirect()->route('kolokiummhs.show', $insert->id)->with('success', 'Data berhasil disimpan! Kumpulkan persyaratan sebelum tanggal pelaksanaan kolokium.');
        } else {
            return back()->with('error', 'Gagal menyimpan data kolokium. Silahkan Coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kolokiummhs $kolokiummhs)
    {
        return view('kolokiummhs.show', compact('kolokiummhs'));
    }

    public function generatePdf($id)
    {
        $kolokiummhs = Kolokiummhs::findOrFail($id);
        
        $template = public_path('pdf/templatekolokium.pdf');
        $outputPath = public_path("pdf/ditandatanganikolokium");

        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }

        $output = $outputPath . "/{$kolokiummhs->nim}_draftkolokium.pdf";
        
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);

        $pdf->SetFont('Times', '', 12);
        $lineHeight = 4.23 * 1.15;

        $pdf->SetXY(80, 35);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->nama, 0, 'L');

        $pdf->SetXY(80, 44);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->nim, 0, 'L');

        $pdf->SetXY(80, 53);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->semester->semester ?? '-', 0, 'L');

        $pdf->SetXY(80, 62);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->alamat, 0, 'L');

        $pdf->SetXY(80, 70);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->judul_kolokium, 0, 'L');

        $pdf->SetXY(80, 87);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->pembimbing1->nama ?? '-', 0, 'L');

        $pdf->SetXY(80, 96);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->pembimbing2->nama ?? 'hfuibwubuefwbj', 0, 'L');

        $pdf->SetXY(80, 105);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->tanggal, 0, 'L');

        $pdf->SetXY(80, 114);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->waktu_mulai . ' s/d ' . $kolokiummhs->waktu_selesai, 0, 'L');

        $pdf->SetXY(80, 123);
        $pdf->MultiCell(100, $lineHeight, $kolokiummhs->ruangan->nama ?? '-', 0, 'L');

        $pdf->SetXY(80, 131);
        $pdf->MultiCell(100, $lineHeight, '', 0, 'L');

        // Simpan PDF
        $pdf->Output('F', $output);

        // Download
        return response()->download($output);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kolokiummhs $kolokiummhs)
    {
        $ruangans = Ruangan::all();
        $semesters = Semester::all();
        $listDosen = StaffDept::all();        
        return view('kolokiummhs.edit', compact('kolokiummhs', 'ruangans', 'semesters', 'listDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kolokiummhs $kolokiummhs)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id', 
            'id_semester' => 'required|exists:semesters,id',
            'id_pembimbing1' => 'required|exists:staff_depts,id',
            'id_pembimbing2' => 'nullable|different:id_pembimbing1|exists:staff_depts,id',   
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai', 
            'judul_kolokium' => 'required|string|max:255',
        ]);

        // Format data seperti di store()
        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']); 
        $data['alamat'] = Str::title($data['alamat']); 
        $data['judul_kolokium'] = Str::title($data['judul_kolokium']);
        $data['waktu_mulai'] = \Carbon\Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = \Carbon\Carbon::parse($data['waktu_selesai'])->format('H:i');

        // Hitung hari kerja
        $tanggalKolokium = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();

        $selisihHariKerja = 0;
        $tanggalCek = $hariIni->copy();
        while ($tanggalCek->lt($tanggalKolokium)) {
            if (!$tanggalCek->isWeekend()) {
                $selisihHariKerja++;
            }
            $tanggalCek->addDay();
        }        

        if ($selisihHariKerja < 4) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal kolokium minimal harus lebih dari 4 hari kerja dari hari ini. Harap pilih tanggal lain.');
        }

        if ($tanggalKolokium->isWeekend()) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal kolokium tidak boleh jatuh pada hari Sabtu atau Minggu. Harap pilih hari kerja.');
        }   

        // Update data
        $update = $kolokiummhs->update($data);

        if ($update) {
            return redirect()->route('kolokiummhs.show', $kolokiummhs->id)->with('success', 'Data berhasil diperbarui!');
        } else {
            return back()->with('error', 'Gagal memperbarui data!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kolokiummhs $kolokiummhs)
    {
        $kolokiummhs->delete();
        return redirect()->route('kolokiummhs.index')->with('success', 'Data kolokium berhasil dihapus!');        
    }
}
