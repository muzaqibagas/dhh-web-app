<?php

namespace App\Http\Controllers;

use App\Models\Seminarmhs;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\StaffDept;
use App\Models\Semester;
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
            return redirect()->route('seminarmhs.show', $seminarmhs->id);
        } else {
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
            'judul_seminar' => 'required|string|max:255',
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
        $words = explode(' ', Str::lower($data['judul_seminar']));
        foreach ($words as $i => $word) {
            if ($i === 0 || !in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_seminar'] = implode(' ', $words);
        if (!$request->id_ruangan && !$request->link_meeting) {
            return back()->withInput()->with('error', 'Pilih ruangan atau isi link meeting.');
        }
        $insert = Seminarmhs::create($data);
        if ($insert) {
            return redirect()->route('seminarmhs.show', $insert->id)->with('success', 'Data seminar berhasil disimpan! Kumpulkan persyaratan sebelum tanggal pelaksanaan seminar.');
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
        $template = public_path('pdf/templateseminar.pdf');
        $outputPath = public_path('pdf/ditandatangani_seminar');
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $output = $outputPath . "/{$seminarmhs->nim}_draftseminar.pdf";
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Times', '', 12);
        $labelWidth = 40;
        $valueWidth = 100;
        $lineHeight = 6.5;
        //nama
        $pdf->SetXY(32, 60);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $seminarmhs->nama, 0, 'L');
        // nim
        $pdf->SetXY(32, 67);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $seminarmhs->nim, 0, 'L');
        //semester
        $pdf->SetXY(32, 75);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $seminarmhs->semester->semester ?? '-', 0, 'L');
        //no hp
        //alamat
        $pdf->SetXY(32, 89);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $seminarmhs->alamat, 0, 'L');
        // Hari/Tanggal
        Carbon::setLocale('id');
        $hariTanggal = Carbon::parse($seminarmhs->tanggal)->translatedFormat('l, d F Y');
        $pdf->SetXY(32, 118);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $hariTanggal, 0, 'L');
        // Waktu
        $pdf->SetXY(32, 126);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $seminarmhs->waktu_mulai . ' s/d ' . $seminarmhs->waktu_selesai, 0, 'L');
        // Tempat offline
        $pdf->SetXY(32, 132.5);
        $pdf->Cell($labelWidth, $lineHeight);
        $tempat = '-';
        if (!empty($seminarmhs->ruangan?->nama)) {
            $tempat = $seminarmhs->ruangan->nama;
        } elseif (!empty($seminarmhs->link_meeting)) {
            $tempat = $seminarmhs->link_meeting;
        }
        $pdf->MultiCell($valueWidth, $lineHeight, $tempat, 0, 'L');
        // Judul Seminar
        $pdf->SetXY(32, 140);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $seminarmhs->judul_seminar, 0, 'L');
        // tanda tangan mahasiswa
        $yMhs = 188;
        $xStart = 210;
        $xEnd = 110;
        $width = $xEnd - $xStart;
        $pdf->SetXY($xStart, $yMhs);
        $pdf->Cell($width, $lineHeight, "(" . ($seminarmhs->nama ?? '-') . ")", 0, 0, 'C');
        //dosen pembimbing 1
        $yPemb1 = 223;
        $xStart = 5;
        $xEnd = 110;
        $width = $xEnd - $xStart;
        $pdf->SetXY($xStart, $yPemb1);
        $pdf->Cell($width, $lineHeight, "(" . ($seminarmhs->pembimbing1->nama ?? '-') . ")", 0, 0, 'C');
        //dosen pembimbing 2
        $yPemb2 = 223;
        $xStart2 = 103;
        $xEnd2 = 215;
        $width2 = $xEnd2 - $xStart2;
        $pdf->SetXY($xStart2, $yPemb2);
        $pdf->Cell($width2, $lineHeight, "(" . ($seminarmhs->pembimbing2->nama ?? '..................................') . ")", 0, 0, 'C');
        $pdf->Output('F', $output);
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
        return view('seminarmhs.edit', compact('seminarmhs', 'ruangans', 'semesters', 'listDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seminarmhs $seminarmhs)
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
            'judul_seminar' => 'required|string|max:255',
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
        $words = explode(' ', Str::lower($data['judul_seminar']));
        foreach ($words as $i => $word) {
            if ($i === 0 || !in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_seminar'] = implode(' ', $words);
        $data['waktu_mulai'] = Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = Carbon::parse($data['waktu_selesai'])->format('H:i');
        $update = $seminarmhs->update($data);
        if ($update) {
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
