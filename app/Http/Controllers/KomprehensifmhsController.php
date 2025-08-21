<?php

namespace App\Http\Controllers;

use App\Models\Komprehensifmhs;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\StaffDept;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class KomprehensifmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswaId = auth()->id();
        $komprehensifmhs = Komprehensifmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($komprehensifmhs) {
            return redirect()->route('komprehensifmhs.show', $komprehensifmhs->id);
        } else {
            return redirect()->route('komprehensifmhs.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswaId = auth()->id();
        $existing = Komprehensifmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($existing) {
            return redirect()
                ->route('komprehensifmhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar komprehensif, silakan edit data yang ada.');
        }
        $komprehensifmhs = Komprehensifmhs::all();
        $listDosen = StaffDept::all();
        $semesters = Semester::all();
        $ruangans = Ruangan::all();
        return view('komprehensifmhs.create', compact('komprehensifmhs', 'listDosen', 'semesters', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();
        $existing = Komprehensifmhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($existing) {
            return redirect()->route('komprehensifmhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar komprehensif, silakan edit data yang ada.');
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
            'judul_tugasakhir' => 'required|string|max:255',
        ]);
        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']);
        $data['alamat'] = Str::title($data['alamat']);
        $data['judul_tugasakhir'] = Str::title($data['judul_tugasakhir']);

        // Hitung hari kerja
        $tanggalKomprehensif = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();
        $selisihHariKerja = 0;
        $tanggalCek = $hariIni->copy();
        while ($tanggalCek->lt($tanggalKomprehensif)) {
            if (!$tanggalCek->isWeekend()) {
                $selisihHariKerja++;
            }
            $tanggalCek->addDay();
        }
        if ($selisihHariKerja < 4) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal komprehensif minimal harus lebih dari 4 hari kerja dari hari ini. Harap pilih tanggal lain.');
        }
        if ($tanggalKomprehensif->isWeekend()) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal komprehensif tidak boleh jatuh pada hari Sabtu atau Minggu. Harap pilih hari kerja.');
        }
        $insert = Komprehensifmhs::create($data);
        if ($insert) {
            return redirect()->route('komprehensifmhs.show', $insert->id)->with('success', 'Data berhasil disimpan! Kumpulkan persyaratan sebelum tanggal pelaksanaan komprehensif.');
        } else {
            return back()->with('error', 'Gagal menyimpan data komprehensif. Silahkan Coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Komprehensifmhs $komprehensifmhs)
    {
        return view('komprehensifmhs.show', compact('komprehensifmhs'));
    }

    public function generatePdf($id)
    {
        $komprehensifmhs = Komprehensifmhs::findOrFail($id);
        
        $template = public_path('pdf/templatekomprehensif.pdf');
        $outputPath = public_path("pdf/ditandatanganikomprehensif");

        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }

        $output = $outputPath . "/{$komprehensifmhs->nim}_draftkomprehensif.pdf";
        
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);

        $pdf->SetFont('Times', '', 12);
        $lineHeight = 4.23 * 1.15;

        $pdf->SetXY(80, 35);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->nama, 0, 'L');

        $pdf->SetXY(80, 44);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->nim, 0, 'L');

        $pdf->SetXY(80, 53);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->semester->semester ?? '-', 0, 'L');

        $pdf->SetXY(80, 62);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->alamat, 0, 'L');

        $pdf->SetXY(80, 70);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->judul_tugasakhir, 0, 'L');

        $pdf->SetXY(80, 87);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->pembimbing1->nama ?? '-', 0, 'L');

        $pdf->SetXY(80, 96);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->pembimbing2->nama ?? 'hfuibwubuefwbj', 0, 'L');

        $pdf->SetXY(80, 105);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->tanggal, 0, 'L');

        $pdf->SetXY(80, 114);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->waktu_mulai . ' s/d ' . $komprehensifmhs->waktu_selesai, 0, 'L');

        $pdf->SetXY(80, 123);
        $pdf->MultiCell(100, $lineHeight, $komprehensifmhs->ruangan->nama ?? '-', 0, 'L');

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
    public function edit(Komprehensifmhs $komprehensifmhs)
    {
        $ruangans = \App\Models\Ruangan::all();
        $semesters = \App\Models\Semester::all();
        $listDosen = \App\Models\StaffDept::all();
        return view('komprehensifmhs.edit', compact('komprehensifmhs', 'ruangans', 'semesters', 'listDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komprehensifmhs $komprehensifmhs)
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
            'judul_tugasakhir' => 'required|string|max:255',
        ]);
        $data['nama'] = \Illuminate\Support\Str::title($data['nama']);
        $data['nim'] = \Illuminate\Support\Str::upper($data['nim']);
        $data['alamat'] = \Illuminate\Support\Str::title($data['alamat']);
        $data['judul_tugasakhir'] = \Illuminate\Support\Str::title($data['judul_tugasakhir']);
        $data['waktu_mulai'] = \Carbon\Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = \Carbon\Carbon::parse($data['waktu_selesai'])->format('H:i');

        // Hitung hari kerja
        $tanggalKomprehensif = \Carbon\Carbon::parse($request->tanggal);
        $hariIni = \Carbon\Carbon::today();
        $selisihHariKerja = 0;
        $tanggalCek = $hariIni->copy();
        while ($tanggalCek->lt($tanggalKomprehensif)) {
            if (!$tanggalCek->isWeekend()) {
                $selisihHariKerja++;
            }
            $tanggalCek->addDay();
        }
        if ($selisihHariKerja < 4) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal komprehensif minimal harus lebih dari 4 hari kerja dari hari ini. Harap pilih tanggal lain.');
        }
        if ($tanggalKomprehensif->isWeekend()) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal komprehensif tidak boleh jatuh pada hari Sabtu atau Minggu. Harap pilih hari kerja.');
        }
        $update = $komprehensifmhs->update($data);
        if ($update) {
            return redirect()->route('komprehensifmhs.show', $komprehensifmhs->id)->with('success', 'Data berhasil diperbarui!');
        } else {
            return back()->with('error', 'Gagal memperbarui data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komprehensifmhs $komprehensifmhs)
    {
        $komprehensifmhs->delete();
        return redirect()->route('komprehensifmhs.index')->with('success', 'Data komprehensif berhasil dihapus!');
    }
}
