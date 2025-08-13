<?php

namespace App\Http\Controllers;

use App\Models\Kolokiummhs;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\StaffDept;
use App\Models\Semester;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class KolokiummhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            return redirect()->route('kolokiummhs.index')->with('success', 'Data berhasil disimpan! Kumpulkan persyaratan sebelum tanggal pelaksanaan kolokium.');
        } else {
            return back()->with('error', 'Gagal menyimpan data!');
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
        // Ambil data kolokium dari database
        $kolokiummhs = Kolokiummhs::findOrFail($id);

        // Path template PDF
        $template = public_path('pdf/templatekolokium.pdf');
        $outputPath = public_path("pdf/ditandatangani");

        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }

        $output = $outputPath . "/{$kolokiummhs->nim}_draft.pdf";

        // Mulai generate PDF
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);

        $pdf->SetFont('Helvetica', '', 12);

        // Isi sesuai format
        $pdf->SetXY(75, 35);
        $pdf->Write(5, $kolokiummhs->nama);

        $pdf->SetXY(75, 44);
        $pdf->Write(5, $kolokiummhs->nim);

        $pdf->SetXY(75, 53);
        $pdf->Write(5, $kolokiummhs->semester->semester ?? '-');

        $pdf->SetXY(75, 62);
        $pdf->Write(5, $kolokiummhs->alamat);

        $pdf->SetXY(75, 70);
        $pdf->Write(5, $kolokiummhs->judul_kolokium);

        $pdf->SetXY(75, 79);
        $pdf->Write(5, $kolokiummhs->pembimbing1->nama ?? '-');

        $pdf->SetXY(75, 87);
        $pdf->Write(5, $kolokiummhs->pembimbing2->nama ?? '-');

        $pdf->SetXY(75, 97);
        $pdf->Write(5, $kolokiummhs->tanggal);

        $pdf->SetXY(75, 105);
        $pdf->Write(5, $kolokiummhs->waktu_mulai . ' s/d ' . $kolokiummhs->waktu_selesai);

        $pdf->SetXY(75, 114);
        $pdf->Write(5, $kolokiummhs->ruangan->nama ?? '-');

        $pdf->SetXY(75, 123);
        $pdf->Write(5, '-');

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
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('kolokiummhs.edit', compact('kolokiummhs', 'ruangans', 'semesters', 'listDosen','mahasiswas'));
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
            return redirect()->route('kolokiummhs.index')->with('success', 'Data berhasil diperbarui!');
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
        return redirect()->route('kolokiummhs.index');
    }
}
