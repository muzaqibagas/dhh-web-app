<?php

namespace App\Http\Controllers;

use App\Models\Seminarmhs;
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

class SeminarmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswaId = auth()->id();
        $seminarmhs = Seminarmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($seminarmhs) {
            // Sudah pernah daftar → lihat detail
            return redirect()->route('seminarmhs.show', $seminarmhs->id);
        } else {
            // Belum pernah daftar → tampilkan form
            return redirect()->route('seminarmhs.create');
        }        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswaId = auth()->id();
        $existing = Seminarmhs::where('id_mahasiswa', $mahasiswaId)->first();

        if ($existing) {
            return redirect()
                ->route('seminarmhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar seminar, silakan edit data yang ada.');
        }

        $seminarmhs = Seminarmhs::all();
        $listDosen = StaffDept::all();
        $semesters = Semester::all();
        $ruangans = Ruangan::all();
        return view('seminarmhs.create', compact('seminarmhs', 'listDosen', 'semesters', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();
        $existing = Seminarmhs::where('id_mahasiswa', $mahasiswaId)->first();

        if ($existing) {
            return redirect()
                ->route('seminarmhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar seminar, silakan edit data yang ada.');
        }

        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id',
            'id_semester' => 'required|exists:semesters,id',
            'id_pembimbing1' => 'required|exists:staff_depts,id',
            'id_pembimbing2' => 'nullable|exists:staff_depts,id',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'judul_seminar' => 'required|string|max:255',
        ]);

        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']);
        $data['alamat'] = Str::title($data['alamat']);
        $data['judul_seminar'] = Str::title($data['judul_seminar']);

        // Hitung hari kerja
        $tanggalSeminar = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();

        $selisihHariKerja = 0;
        $tanggalCek = $hariIni->copy();
        while($tanggalCek->lt($tanggalSeminar)){
            if (!$tanggalCek->isWeekend()){
                $selisihHariKerja++;
            }                
            $tanggalCek->addDay();
        }

        if ($selisihHariKerja < 4) {
            return back()
            ->withInput()
            ->with('error', 'Tanggal Seminar minimal harus lebih dari 4 hari kerja dari hari ini. Harap pilih tanggal lain.');
        }

        if ($tanggalSeminar->isWeekend()){
            return back()
            ->withInput()
            ->with('error', 'Tanggal Seminar tidak boleh jatuh pada hari Sabtu atau Minggu. Harap pilih hari kerja.');
        }

        // Simpan ke DB dulu
        $insert = Seminarmhs::create($data);

        if ($insert){
            return redirect()->route('seminarmhs.show', $insert->id)->with('success', 'Data berhasil disimpan! kumpulkan persyaratan sebelum tanggal pelaksanaan seminar');            
        } else {
            return back()->with('error', 'Gagal menyimpan data seminar. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Seminarmhs $seminarmhs)
    {
        return view('seminarmhs.show', compact('seminarmhs'));
    }

    public function generatePdf($id)
    {
        $seminarmhs = Seminarmhs::findOrFail($id);
        
        $template = public_path('assets/pdf/templateseminar.pdf');
        $outputPath = public_path("pdf/ditandatanganiseminar");

        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0755, true);
        }

        $output = $outputPath . "/{$seminarmhs->nim}_draftseminar.pdf";

        $pdf = new Fpdi();
        $pdf->Addpage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);

        $pdf->SetFont('Times', '', 12);
        $lineHeight = 4.23 * 1.15;

        $pdf->SetXY(80, 35);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->nama, 0, 'L');

        $pdf->SetXY(80, 44);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->nim, 0, 'L');

        $pdf->SetXY(80, 53);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->semester->semester ?? '-', 0, 'L');

        $pdf->SetXY(80, 62);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->alamat, 0, 'L');

        $pdf->SetXY(80, 70);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->judul_kolokium, 0, 'L');

        $pdf->SetXY(80, 87);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->pembimbing1->nama ?? '-', 0, 'L');

        $pdf->SetXY(80, 96);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->pembimbing2->nama ?? 'hfuibwubuefwbj', 0, 'L');

        $pdf->SetXY(80, 105);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->tanggal, 0, 'L');

        $pdf->SetXY(80, 114);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->waktu_mulai . ' s/d ' . $kolokiummhs->waktu_selesai, 0, 'L');

        $pdf->SetXY(80, 123);
        $pdf->MultiCell(100, $lineHeight, $seminarmhs->ruangan->nama ?? '-', 0, 'L');

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
    public function edit(Seminarmhs $seminarmhs)
    {
        $ruangans = Ruangan::all();    
        $semesters = Semester::all();
        $listDosen = StaffDept::all();
        return view('seminarmhs.edit', compact('seminarmhs', 'ruangans', 'listDosen', 'semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seminarmhs $seminarmhs)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id',
            'id_semester' => 'required|exists:semesters,id',
            'id_pembimbing1' => 'required|exists:staff_depts,id',
            'id_pembimbing2' => 'nullable|exists:staff_depts,id',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'judul_seminar' => 'required|string|max:255',
        ]);

        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']);
        $data['alamat'] = Str::title($data['alamat']);
        $data['judul_seminar'] = Str::title($data['judul_seminar']);
        $data['waktu_mulai'] = Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = Carbon::parse($data['waktu_selesai'])->format('H:i');

        // Hitung hari kerja
        $tanggalSeminar = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();

        $selisihHariKerja = 0;
        $tanggalCek = $hariIni->copy();
        while($tanggalCek->lt($tanggalSeminar)){
            if (!$tanggalCek->isWeekend()){
                $selisihHariKerja++;
            }                
            $tanggalCek->addDay();
        }

        if ($selisihHariKerja < 4) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal Seminar minimal harus lebih dari 4 hari kerja dari hari ini. Harap pilih tanggal lain.');
        }

        if ($tanggalSeminar->isWeekend()){
            return back()
                ->withInput()
                ->with('error', 'Tanggal Seminar tidak boleh jatuh pada hari Sabtu atau Minggu. Harap pilih hari kerja.');
        }

        // Update data
        $update = $seminarmhs->update($data);

        if ($update){
            return redirect()->route('seminarmhs.show', $seminarmhs->id)->with('success', 'Data seminar berhasil diperbarui!');
        } else {
            return back()->with('error', 'Gagal memperbarui data seminar. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminarmhs $seminarmhs)
    {        
        $seminarmhs->delete();
        return redirect()->route('seminarmhs.index')->with('success', 'Data seminar berhasil dihapus!');
    }
}
