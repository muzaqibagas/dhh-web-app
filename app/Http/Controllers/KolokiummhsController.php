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
            'id_ruangan' => 'required_if:tipe_pelaksanaan,offline|nullable|exists:ruangans,id',
            'link_meeting' => 'required_if:tipe_pelaksanaan,online|nullable|url',
            'tipe_pelaksanaan' => 'required|in:offline,online',
        ]);
        // Set field sesuai tipe pelaksanaan
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
        $words = explode(' ', Str::lower($data['judul_kolokium']));

        foreach ($words as $i => $word) {
            if ($i === 0 || !in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_kolokium'] = implode(' ', $words);

        if (!$request->id_ruangan && !$request->link_meeting) {
            return back()->withInput()->with('error', 'Pilih ruangan atau isi link meeting.');
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

        $labelWidth = 40;   // lebar kolom label
        $valueWidth = 100;  // lebar kolom isi
        $lineHeight = 6.5;

        // Nama Mahasiswa
        $pdf->SetXY(32, 60);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->nama, 0, 'L');

        // NIM
        $pdf->SetXY(32, 68);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->nim, 0, 'L');

        // Semester
        $pdf->SetXY(32, 75);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->semester->semester ?? '-', 0, 'L');

        // Alamat
        $pdf->SetXY(32, 82);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->alamat, 0, 'L');

        // Hari/Tanggal
        Carbon::setLocale('id');
        $hariTanggal = Carbon::parse($kolokiummhs->tanggal)->translatedFormat('l, d F Y');
        $pdf->SetXY(32, 104);
        $pdf->Cell($labelWidth, $lineHeight);        
        $pdf->MultiCell($valueWidth, $lineHeight, $hariTanggal, 0, 'L');

        // Waktu
        $pdf->SetXY(32, 111.5);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->waktu_mulai . ' s/d ' . $kolokiummhs->waktu_selesai, 0, 'L');

        // Tempat offline
        $pdf->SetXY(32, 119);
        $pdf->Cell($labelWidth, $lineHeight);
        $tempat = '-';
        if (!empty($kolokiummhs->ruangan?->nama)) {
            $tempat = $kolokiummhs->ruangan->nama;
        } elseif (!empty($kolokiummhs->link_meeting)) {
            $tempat = $kolokiummhs->link_meeting;
        }
        $pdf->MultiCell($valueWidth, $lineHeight, $tempat, 0, 'L');        

        // Judul Kolokium
        $pdf->SetXY(32, 126);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->judul_kolokium, 0, 'L');                

        //Mahasiswa yang mendaftarkan kolokium               
        $yMhs = 188;
        
        $xStart = 210; // posisi X kurung buka
        $xEnd   = 110; // posisi X kurung tutup
        $width  = $xEnd - $xStart; // lebar area kurung

        $pdf->SetXY($xStart, $yMhs);
        $pdf->Cell(
            $width, 
            $lineHeight, 
            "(" . ($kolokiummhs->nama ?? '-') . ")", 
            0, 
            0, 
            'C' // <-- ini bikin teks center
        );

        // Dosen Pembimbing 1 
        $yPemb1 = 223;
        
        $xStart = 5;  // posisi X kurung buka
        $xEnd   = 110; // posisi X kurung tutup
        $width  = $xEnd - $xStart; // lebar area kurung

        $pdf->SetXY($xStart, $yPemb1);
        $pdf->Cell($width, $lineHeight, "(" . ($kolokiummhs->pembimbing1->nama ?? '-' ) . ")",             0, 0, 'C');

        // Untuk pembimbing anggota (misalnya di X kanan, Y sama)
        $yPemb2 = 223;
        $xStart2 = 103;  // posisinya harus disesuaikan dengan kurung kanan
        $xEnd2   = 215;  // sesuaikan dengan kurung kanan
        $width2  = $xEnd2 - $xStart2;

        $pdf->SetXY($xStart2, $yPemb2);
        $pdf->Cell($width2, $lineHeight, "(" . ($kolokiummhs->pembimbing2->nama ?? '..................................') . ")", 0, 0, 'C');

        // Simpan PDF
        $pdf->Output('F', $output);

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
            'id_ruangan' => 'required_if:tipe_pelaksanaan,offline|nullable|exists:ruangans,id',
            'link_meeting' => 'required_if:tipe_pelaksanaan,online|nullable|url',
            'tipe_pelaksanaan' => 'required|in:offline,online',
        ]);

        // Format data seperti di store()
        $data['nama'] = Str::title($data['nama']);
        $data['nim'] = Str::upper($data['nim']); 
        $data['alamat'] = Str::title($data['alamat']);  
        $lowerWords = ['dan', 'atau', 'ke', 'dari', 'di', 'pada', 'dengan', 'untuk', 'yang', 'sebagai', 'dalam', 'oleh', 'seperti', 'karena', 
                       'tetapi', 'jika', 'bahwa', 'adalah', 'ini', 'itu', 'saat', 'sebelum', 'sesudah', 'hingga', 'meskipun', 'walaupun', 
                       'supaya', 'agar', 'sementara', 'selama', 'antara', 'tanpa', 'hanya', 'maka', 'sedang'];
        $words = explode(' ', Str::lower($data['judul_kolokium']));

        foreach ($words as $i => $word) {
            if ($i === 0 || !in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_kolokium'] = implode(' ', $words);               
        $data['waktu_mulai'] = \Carbon\Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = \Carbon\Carbon::parse($data['waktu_selesai'])->format('H:i');

        // Hitung hari kerja
        $tanggalKolokium = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();

        // Set field sesuai tipe pelaksanaan
        if ($data['tipe_pelaksanaan'] === 'online') {
            $data['id_ruangan'] = null;
        } else {
            $data['link_meeting'] = null;
        }
        
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
