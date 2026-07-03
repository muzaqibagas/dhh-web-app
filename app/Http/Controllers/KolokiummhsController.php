<?php

namespace App\Http\Controllers;

use App\Models\KetuaDHH;
use App\Models\Kolokiummhs;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\StaffDept;
use App\Models\StaffNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;

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
        $ruanganKolokium = Ruangan::whereHas('jenis', function ($q) {
            $q->where('jenis', 'kolokium');
        })->get();

        return view('kolokiummhs.create', compact('kolokiummhs', 'listDosen', 'semesters', 'ruanganKolokium'));
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
            'id_komisipendidikan' => 'required|exists:staff_depts,id',
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
            if ($i === 0 || ! in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_kolokium'] = implode(' ', $words);

        if (! $request->id_ruangan && ! $request->link_meeting) {
            return back()->withInput()->with('error', 'Pilih ruangan atau isi link meeting.');
        }

        // Simpan ke DB dulu
        $insert = Kolokiummhs::create($data);

        if ($insert) {
            $nama = $insert->nama;
            $judul = $insert->judul_kolokium;

            // notif pembimbing 1
            $this->sendStaffNotification(
                $insert->id_pembimbing1,
                '📢 Mahasiswa Bimbingan Mengajukan Kolokium',
                "Mahasiswa {$nama} mengajukan kolokium dengan judul: {$judul}.",
                route('jadwalta.index')
            );

            // notif pembimbing 2 (kalau ada)
            if ($insert->id_pembimbing2) {
                $this->sendStaffNotification(
                    $insert->id_pembimbing2,
                    '📢 Mahasiswa Bimbingan Mengajukan Kolokium',
                    "Mahasiswa {$nama} mengajukan kolokium dengan judul: {$judul}.",
                    route('jadwalta.index')
                );
            }
        }

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
        $kolokiummhs->load(['syaratUjian.moderator']);

        return view('kolokiummhs.show', compact('kolokiummhs'));
    }

    public function generatePdf($id)
    {
        $kolokiummhs = Kolokiummhs::findOrFail($id);
        $ketuaDhh = KetuaDHH::orderByDesc('tahun_mulai')->first();
        $template = public_path('pdf/templatekolokium.pdf');
        $outputPath = public_path('pdf/ditandatanganikolokium');
        if (! file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $output = $outputPath."/{$kolokiummhs->nim}_draftkolokium.pdf";
        $pdf = new Fpdi;
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Times', '', 12);
        $labelWidth = 40;
        $valueWidth = 120;
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
        // no hp
        $pdf->SetXY(32, 82);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->mahasiswa->no_hp ?? '-', 0, 'L');
        // Alamat
        $pdf->SetXY(32, 89);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->alamat, 0, 'L');
        // Hari/Tanggal
        Carbon::setLocale('id');
        $hariTanggal = Carbon::parse($kolokiummhs->tanggal)->translatedFormat('l, d F Y');
        $pdf->SetXY(32, 118);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $hariTanggal, 0, 'L');
        // Waktu
        $pdf->SetXY(32, 126);
        $pdf->Cell($labelWidth, $lineHeight);
        $waktuMulai = Carbon::parse($kolokiummhs->waktu_mulai)->format('H:i');
        $waktuSelesai = Carbon::parse($kolokiummhs->waktu_selesai)->format('H:i');
        $pdf->MultiCell($valueWidth, $lineHeight, $waktuMulai.' s/d '.$waktuSelesai, 0, 'L');
        // Tempat offline
        $pdf->SetXY(32, 132.5);
        $pdf->Cell($labelWidth, $lineHeight);
        $tempat = '-';
        if (! empty($kolokiummhs->ruangan?->nama)) {
            $tempat = $kolokiummhs->ruangan->nama;
        } elseif (! empty($kolokiummhs->link_meeting)) {
            $tempat = $kolokiummhs->link_meeting;
        }
        $pdf->MultiCell($valueWidth, $lineHeight, $tempat, 0, 'L');
        // Judul Kolokium
        $pdf->SetXY(32, 140);
        $pdf->Cell($labelWidth, $lineHeight);
        $pdf->MultiCell($valueWidth, $lineHeight, $kolokiummhs->judul_kolokium, 0, 'L');
        // tanda tangan mahasiswa
        $yMhs = 188;
        $xStart = 210;
        $xEnd = 110;
        $width = $xEnd - $xStart;
        $pdf->SetXY($xStart, $yMhs);
        $pdf->Cell($width, $lineHeight, '('.($kolokiummhs->nama ?? '-').')', 0, 0, 'C'
        );
        // Dosen Pembimbing 1
        $yPemb1 = 223;
        $xStart = 5;
        $xEnd = 110;
        $width = $xEnd - $xStart;
        $pdf->SetXY($xStart, $yPemb1);
        $pdf->Cell($width, $lineHeight, '('.($kolokiummhs->pembimbing1->nama ?? '-').')', 0, 0, 'C');
        // Dosen Pembimbing 2
        $yPemb2 = 223;
        $xStart2 = 103;
        $xEnd2 = 215;
        $width2 = $xEnd2 - $xStart2;
        $pdf->SetXY($xStart2, $yPemb2);
        $pdf->Cell($width2, $lineHeight, '('.($kolokiummhs->pembimbing2->nama ?? '..................................').')', 0, 0, 'C');
        // komisi pendidikan
        $yKetua = 263;
        $xStart3 = 52;
        $xEnd3 = 160;
        $width3 = $xEnd3 - $xStart3;
        $pdf->SetXY($xStart3, $yKetua);
        $pdf->Cell($width3, $lineHeight, '('.($kolokiummhs->komisipendidikan->nama ?? '..................................').')', 0, 0, 'C');

        // Simpan PDF
        $pdf->Output('F', $output);

        return response()->download($output);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kolokiummhs $kolokiummhs)
    {
        $semesters = Semester::all();
        $listDosen = StaffDept::all();
        $ruanganKolokium = Ruangan::whereHas('jenis', function ($q) {
            $q->where('jenis', 'kolokium');
        })->get();

        return view('kolokiummhs.edit', compact('kolokiummhs', 'ruanganKolokium', 'semesters', 'listDosen'));
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
            'id_komisipendidikan' => 'required|exists:staff_depts,id',
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
            if ($i === 0 || ! in_array($word, $lowerWords)) {
                $words[$i] = Str::ucfirst($word);
            }
        }
        $data['judul_kolokium'] = implode(' ', $words);
        $data['waktu_mulai'] = Carbon::parse($data['waktu_mulai'])->format('H:i');
        $data['waktu_selesai'] = Carbon::parse($data['waktu_selesai'])->format('H:i');

        // Hitung hari kerja
        $tanggalKolokium = Carbon::parse($request->tanggal);
        $hariIni = Carbon::today();

        // Set field sesuai tipe pelaksanaan
        if ($data['tipe_pelaksanaan'] === 'online') {
            $data['id_ruangan'] = null;
        } else {
            $data['link_meeting'] = null;
        }

        $kolokiummhs->fill($data);

        if (! $kolokiummhs->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        $update = $kolokiummhs->update($data);

        if ($update) {
            $nama = $kolokiummhs->nama;
            $judul = $kolokiummhs->judul_kolokium;

            // notif pembimbing 1
            $this->sendStaffNotification(
                $kolokiummhs->id_pembimbing1,
                '✏️ Data Kolokium Diperbarui',
                "Mahasiswa {$nama} memperbarui data kolokium dengan judul: {$judul}.",
                route('jadwalta.index')
            );

            // notif pembimbing 2
            if ($kolokiummhs->id_pembimbing2) {
                $this->sendStaffNotification(
                    $kolokiummhs->id_pembimbing2,
                    '✏️ Data Kolokium Diperbarui',
                    "Mahasiswa {$nama} memperbarui data kolokium dengan judul: {$judul}.",
                    route('jadwalta.index')
                );
            }

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

    private function sendStaffNotification($staffId, $title, $message, $redirect = null)
    {
        if (! $staffId) {
            return;
        }

        StaffNotification::create([
            'staff_id' => $staffId,
            'title' => $title,
            'message' => $message,
            'redirect_url' => $redirect,
        ]);
    }
}
