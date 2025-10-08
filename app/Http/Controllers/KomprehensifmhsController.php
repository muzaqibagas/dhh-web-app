<?php

namespace App\Http\Controllers;

use App\Models\Komprehensifmhs;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\StaffDept;
use App\Models\Semester;
use App\Models\KetuaDhh;
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
            return redirect()
                ->route('komprehensifmhs.show', $existing->id)
                ->with('error', 'Anda sudah mendaftar komprehensif, silakan edit data yang ada.');
        }
        $data = $request->validate([            
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
            'id_ruangan' => 'required_if:tipe_pelaksanaan,offline|nullable|exists:ruangans,id',
            'link_meeting' => 'required_if:tipe_pelaksanaan,online|nullable|url',
            'tipe_pelaksanaan' => 'required|in:offline,online',
        ]);
        if ($data['tipe_pelaksanaan'] === 'online') {
            $data['id_ruangan'] = null;
        } else {
            $data['link_meeting'] = null;
        }
        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']);
        $data['alamat'] = Str::title($data['alamat']);        
        $lowerWords = ['dan', 'atau', 'ke', 'dari', 'di', 'pada', 'dengan', 'untuk', 'yang', 'sebagai', 'dalam', 'oleh', 'seperti', 'karena',
                       'tetapi', 'jika', 'bahwa', 'adalah', 'ini', 'itu', 'saat', 'sebelum', 'sesudah', 'hingga', 'meskipun', 'walaupun',
                       'supaya', 'agar', 'sementara', 'selama', 'antara', 'tanpa', 'hanya', 'maka', 'sedang'];
        $words = explode(' ', Str::lower($data['judul_tugasakhir']));
        foreach ($words as $i => $word) {
            if ($i === 0 || !in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_tugasakhir'] = implode(' ', $words);
        if (!$request->id_ruangan && !$request->link_meeting) {
            return back()->withInput()->with('error', 'Pilih ruangan atau isi link meeting.');
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
        $ketuaDhh = KetuaDhh::orderByDesc('tahun_mulai')->first();        
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
        $labelWidth = 40;
        $valueWidth = 100;
        $lineHeight = 6.5;
        // Nama Mahasiswa
        $pdf->SetXY(32, 60);        
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $komprehensifmhs->nama, 0, 'L');
        //nim
        $pdf->SetXY(32, 67);
        $pdf->Cell($labelWidth, $lineHeight);        
        $pdf->MultiCell($valueWidth, $lineHeight, $komprehensifmhs->nim, 0, 'L');
        //semester
        $pdf->SetXY(32, 75);
        $pdf->Cell($labelWidth, $lineHeight);        
        $pdf->MultiCell($valueWidth, $lineHeight, $komprehensifmhs->semester->semester ?? '-', 0, 'L');
        //no hp
        //alamat
        $pdf->SetXY(32, 89);
        $pdf->Cell($labelWidth, $lineHeight);        
        $pdf->MultiCell($valueWidth, $lineHeight, $komprehensifmhs->alamat, 0, 'L');
        // Hari/Tanggal
        Carbon::setLocale('id');
        $hariTanggal = Carbon::parse($komprehensifmhs->tanggal)->translatedFormat('l, d F Y');
        $pdf->SetXY(32, 118);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $hariTanggal, 0, 'L');
        // Waktu
        $pdf->SetXY(32, 126);
        $pdf->Cell($labelWidth, $lineHeight);
        $waktuMulai = \Carbon\Carbon::parse($komprehensifmhs->waktu_mulai)->format('H:i');
        $waktuSelesai = \Carbon\Carbon::parse($komprehensifmhs->waktu_selesai)->format('H:i');
        $pdf->MultiCell($valueWidth, $lineHeight, $waktuMulai . ' s/d ' . $waktuSelesai, 0, 'L');
        // Tempat offline
        $pdf->SetXY(32, 132.5);
        $pdf->Cell($labelWidth, $lineHeight);
        $tempat = '-';
        if (!empty($komprehensifmhs->ruangan?->nama)) {
            $tempat = $komprehensifmhs->ruangan->nama;
        } elseif (!empty($komprehensifmhs->link_meeting)) {
            $tempat = $komprehensifmhs->link_meeting;
        }
        $pdf->MultiCell($valueWidth, $lineHeight, $tempat, 0, 'L');
        // Judul Tugas Akhir
        $pdf->SetXY(32, 140);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $komprehensifmhs->judul_tugasakhir, 0, 'L');        
        // tanda tangan mahasiswa
        $yMhs = 188;
        $xStart = 210;
        $xEnd = 110;
        $width = $xEnd - $xStart;
        $pdf->SetXY($xStart, $yMhs);
        $pdf->Cell($width, $lineHeight, "(" . ($komprehensifmhs->nama ?? '-') . ")", 0, 0, 'C');
        //dosen pembimbing 1
        $yPemb1 = 223;
        $xStart = 5;
        $xEnd = 110;
        $width = $xEnd - $xStart;
        $pdf->SetXY($xStart, $yPemb1);
        $pdf->Cell($width, $lineHeight, "(" . ($komprehensifmhs->pembimbing1->nama ?? '-') . ")", 0, 0, 'C');
        //dosen pembimbing 2
        $yPemb2 = 223;
        $xStart2 = 103;
        $xEnd2 = 215;
        $width2 = $xEnd2 - $xStart2;
        $pdf->SetXY($xStart2, $yPemb2);
        $pdf->Cell($width2, $lineHeight, "(" . ($komprehensifmhs->pembimbing2->nama ?? '..................................') . ")", 0, 0, 'C');       
        //ketua dhh
        $yKetua = 263; 
        $xStart3 = 55;  
        $xEnd3   = 160; 
        $width3  = $xEnd3 - $xStart3;
        $pdf->SetXY($xStart3, $yKetua);
        $pdf->Cell($width3, $lineHeight, "(" . ($ketuaDhh->nama ?? '..................................') . ")",0, 0, 'C');

        // Simpan PDF
        $pdf->Output('F', $output);
        
        return response()->download($output);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komprehensifmhs $komprehensifmhs)
    {
        $ruangans = Ruangan::all();
        $semesters = Semester::all();
        $listDosen = StaffDept::all();
        return view('komprehensifmhs.edit', compact('komprehensifmhs', 'ruangans', 'semesters', 'listDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komprehensifmhs $komprehensifmhs)
    {
        $data = $request->validate([
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
            'id_ruangan' => 'required_if:tipe_pelaksanaan,offline|nullable|exists:ruangans,id',
            'link_meeting' => 'required_if:tipe_pelaksanaan,online|nullable|url',
            'tipe_pelaksanaan' => 'required|in:offline,online',
        ]);
        if ($data['tipe_pelaksanaan'] === 'online') {
            $data['id_ruangan'] = null;
        } else {
            $data['link_meeting'] = null;
        }
        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']);
        $data['alamat'] = Str::title($data['alamat']);        
        $lowerWords = ['dan', 'atau', 'ke', 'dari', 'di', 'pada', 'dengan', 'untuk', 'yang', 'sebagai', 'dalam', 'oleh', 'seperti', 'karena',
                       'tetapi', 'jika', 'bahwa', 'adalah', 'ini', 'itu', 'saat', 'sebelum', 'sesudah', 'hingga', 'meskipun', 'walaupun',
                       'supaya', 'agar', 'sementara', 'selama', 'antara', 'tanpa', 'hanya', 'maka', 'sedang'];
        $words = explode(' ', Str::lower($data['judul_tugasakhir']));
        foreach ($words as $i => $word) {
            if ($i === 0 || !in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_tugasakhir'] = implode(' ', $words);
        $data['waktu_mulai'] = Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = Carbon::parse($data['waktu_selesai'])->format('H:i');        
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
