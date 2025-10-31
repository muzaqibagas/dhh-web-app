<?php

namespace App\Http\Controllers;

use App\Models\SyaratKolokiummhs;
use App\Models\Kolokiummhs;
use App\Models\StaffDept;
use App\Models\User;
use App\Models\Notification as AppNotification;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SyaratKolokiummhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listModerator = StaffDept::all();
        $search = $request->input('search');

        $pendaftar = SyaratKolokiummhs::with('mahasiswa')
            ->where('status', '!=', 'ditolak') 
            ->where('bap', '!=', 'ditolak')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->get();
        return view('syaratkolokiummhs.index', compact('pendaftar', 'listModerator'));
    }

    public function setujui(Request $request, $id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $syarat->update([
            'status' => 'disetujui',
            'alasan_formulir' => null,
            'alasan_bukti_sks' => null,
            'alasan_bukti_spp' => null,
            'alasan_bukti_kehadiran' => null,
        ]);

        $this->sendNotification(
            $syarat->id_mahasiswa,
            '🔔 Berkas Persayaratan Kolokium Disetujui',
            'Berkas persyaratan kolokium anda telah disetujui. Selamat melaksanakan Kolokium!',
            route('syaratkolokiummhs.create', $syarat->id)
        );

         return redirect()->back()->with('success', 'Syarat pendaftaran Kolokium telah disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);        
        
        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        if (
            empty($request->alasan_formulir) &&
            empty($request->alasan_bukti_sks) &&
            empty($request->alasan_bukti_spp) &&
            empty($request->alasan_bukti_kehadiran)
        ) {
            return redirect()->back()->with('error', 'Minimal satu alasan penolakan harus diisi.');
        }

        $syarat->update([
            'status' => 'ditolak',
            'alasan_formulir' => $request->alasan_formulir,
            'alasan_bukti_sks' => $request->alasan_bukti_sks,
            'alasan_bukti_spp' => $request->alasan_bukti_spp,
            'alasan_bukti_kehadiran' => $request->alasan_bukti_kehadiran,
        ]);

        $reasons = [
            'Formulir' => $request->alasan_formulir,
            'Bukti SKS' => $request->alasan_bukti_sks,
            'Bukti SPP' => $request->alasan_bukti_spp,
            'Bukti Kehadiran' => $request->alasan_bukti_kehadiran,
        ];

        // Filter hanya yang diisi dan format bullet list
        $reasonMessage = "⚠️ Berkas persyaratan kolokium anda perlu diperbaiki:<br><ul>";
        foreach ($reasons as $field => $msg) {
            if ($msg) {
                $reasonMessage .= "<li><b>{$field}</b>: {$msg}</li>";
            }
        }
        $reasonMessage .= "</ul>";


        // ✅ Kirim notifikasi
        $this->sendNotification(
            $syarat->id_mahasiswa,
            '🔔 Perlu Revisi Berkas',
            $reasonMessage,
            route('syaratkolokiummhs.create', $syarat->id)
        );
        
        return redirect()->back()->with('success', 'Syarat Kolokium ditolak. Alasan penolakan telah disimpan.');
    }

    public function downloadPdf($id)
    {
        $syarat = SyaratKolokiummhs::with(['mahasiswa', 'moderator'])->findOrFail($id);
        $kolokium = Kolokiummhs::with([
            'mahasiswa',
            'ruangan',
            'semester',
            'pembimbing1',
            'pembimbing2'
        ])->where('id_mahasiswa', $syarat->id_mahasiswa)->first();

        if (!$kolokium) {
            return back()->with('error', 'Mahasiswa ini belum melakukan pendaftaran Kolokium.');
        }

        $template = public_path('undangan/templateundangankolokium.pdf');
        $outputPath = public_path('undangan/undangankolokium');
        if (!file_exists($outputPath)) 
            mkdir($outputPath, 0777, true);
        $output = $outputPath . "/{$kolokium->nim}_undangankolokium.pdf";

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Times', '', 12);
        
        Carbon::setLocale('id');
        $tanggalCarbon = Carbon::parse($kolokium->tanggal);
        $hari = ucfirst($tanggalCarbon->translatedFormat('l'));
        $tanggal = $tanggalCarbon->translatedFormat('d F Y');         
        $mulai = Carbon::parse($kolokium->waktu_mulai)->format('H.i');
        $selesai = Carbon::parse($kolokium->waktu_selesai)->format('H.i');
        
        $tempat = ($kolokium->tipe_pelaksanaan === 'offline')
            ? ($kolokium->ruangan->nama ?? '-')
            : ($kolokium->link_meeting ?? '-');
    
        $moderator = $syarat->moderator->nama ?? '-';              

        $pdf->SetXY(23, 105);
        $pdf->MultiCell(32, 6, "{$kolokium->mahasiswa->nama} / {$kolokium->nim}", 0, 'L');
    
        $pdf->SetXY(59, 105);
        $pdf->MultiCell(32, 6, "{$hari} /\n{$tanggal}", 0, 'L');
        
        $pdf->SetXY(95, 105);
        $pdf->MultiCell(32, 6, "{$mulai} - {$selesai} WIB /\n{$tempat}", 0, 'L');
        
        $pdf->SetXY(131, 105);
        $pdf->MultiCell(65, 6, $kolokium->judul_kolokium, 0, 'L');
        
        $pdf->SetXY(131, 130);
        $pdf->MultiCell(65, 6, $kolokium->pembimbing1->nama ?? '-', 0, 'L');
        
        $pdf->SetXY(131, 148.8);
        $pdf->MultiCell(65, 6, $kolokium->pembimbing2->nama ?? '-', 0, 'L');
        
        $pdf->SetXY(131, 168.3);
        $pdf->MultiCell(65, 6, $moderator, 0, 'L');
        
        $pdf->SetXY(125, 201.5);
        $pdf->Cell(0, 6, now()->translatedFormat('d F Y'), 0, 1, 'L');        

        $pdf->Output($output, 'F');
        return response()->download($output);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswaId = auth()->id();

        $kolokium = Kolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();
        if (!$kolokium) {            
            return redirect()
                ->route('kolokiummhs.create')
                ->with('error', 'Anda belum mendaftar kolokium. Silakan daftar terlebih dahulu sebelum mengisi persyaratan.');
        }

        $syarat = SyaratKolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();        

        return view('syaratkolokiummhs.create', compact('syarat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaId = auth()->id();

        $existing = SyaratKolokiummhs::where('id_mahasiswa', $mahasiswaId)->first();
        if ($existing && $existing->status === 'disetujui') {
            return redirect()->back()->with('error', 'Anda sudah memiliki pendaftaran yang disetujui. Tidak dapat mengajukan lagi.');
        }

        if ($existing && $existing->bap === 'ditolak' && !$request->hasFile('formulir')) {
            return redirect()->back()->with('error', 'Silakan unggah ulang formulir, anda belum melaksanakan kolokium.');
        }

        $data = $request->validate([            
            'formulir' => 'required|mimes:pdf|max:2048',
            'bukti_sks' => 'required|mimes:pdf|max:2048',
            'bukti_spp' => 'required|mimes:pdf|max:2048',
            'bukti_kehadiran' => 'required|mimes:pdf|max:2048',
        ]);
        
        $data = [
            'id_mahasiswa' => $mahasiswaId,
            'status' => 'pending',
            'bap' => 'belum_melaksanakan',
        ];

        $user = auth()->user(); 
        $folderName = $user->nama . '_' . $user->nim; 
        
        $destinationPath = public_path('syarat_kolokium/' . $folderName);
        
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

        $this->sendNotification($mahasiswaId, 
            '🔔 Berkas Kolokium Diajukan', 
            'Berkas persyaratan kolokium berhasil diunggah. Menunggu pengecekan admin.',
            route('syaratkolokiummhs.create')
        );

        return redirect()->back()->with('success', 'Berkas pendaftaran seminar berhasil diajukan dan sedang menunggu persetujuan.');
    }

    public function reupload(Request $request, $id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);
        $user = auth()->user();
        $nim = $user->nim;
        $folderName = $user->nama . '_' . $nim;
        $destinationPath = public_path('syarat_kolokium/' . $folderName);
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        
        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $fileName = 'formulir_kolokium_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->formulir = 'syarat_kolokium/' . $folderName . '/' . $fileName;
            $syarat->alasan_formulir = null;
        }

        if ($request->hasFile('bukti_sks')) {
            $file = $request->file('bukti_sks');
            $fileName = 'bukti_sks_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_sks = 'syarat_kolokium/' . $folderName . '/' . $fileName;
            $syarat->alasan_bukti_sks = null;
        }

        if ($request->hasFile('bukti_spp')) {
            $file = $request->file('bukti_spp');
            $fileName = 'bukti_spp_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_spp = 'syarat_kolokium/' . $folderName . '/' . $fileName;
            $syarat->alasan_bukti_spp = null;
        }

        if ($request->hasFile('bukti_kehadiran')) {
            $file = $request->file('bukti_kehadiran');
            $fileName = 'bukti_kehadiran_' . $nim . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $syarat->bukti_kehadiran = 'syarat_kolokium/' . $folderName . '/' . $fileName;
            $syarat->alasan_bukti_kehadiran = null;
        }
        
        if (
            !$syarat->alasan_formulir &&
            !$syarat->alasan_bukti_sks &&
            !$syarat->alasan_bukti_spp &&
            !$syarat->alasan_bukti_kehadiran
        ) {
            $syarat->status = 'pending';
            $syarat->bap = 'belum_melaksanakan';
        }

        $syarat->save();

        $this->sendNotification($syarat->id_mahasiswa,
            '🔔 Berkas Persyaratan Kolokium Diunggah Ulang', 
            'Berkas perbaikan persyaratan kolokium berhasil diunggah. Menunggu verifikasi ulang.',
            route('syaratkolokiummhs.create')
        );


        return redirect()->back()->with('success', 'Berkas pendaftaran kolokium berhasil diunggah ulang dan sedang menunggu persetujuan.');
    }

    public function bapDiterima(Request $request, $id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);

        $syarat->update([
            'status' => 'disetujui',
            'bap' => 'diterima',
        ]);

        $this->sendNotification($syarat->id_mahasiswa,
            '🔔 Kolokium Selesai',
            'Selamat Anda sudah melaksanakan Kolokium, silakan lanjut ke Seminar Hasil!.',
            route('seminarmhs.create', $syarat->id)
        );


         return redirect()->back()->with('success', 'BAP Kolokium telah diterima.');
    }

    public function bapDitolak(Request $request, $id)
    {
        $syarat = SyaratKolokiummhs::findOrFail($id);

        $request->validate([
            'alasan_formulir' => 'nullable|string|max:500',
            'alasan_bukti_sks' => 'nullable|string|max:500',
            'alasan_bukti_spp' => 'nullable|string|max:500',
            'alasan_bukti_kehadiran' => 'nullable|string|max:500',
        ]);

        $syarat->update([
            'status' => 'ditolak',
            'bap' => 'ditolak',
            'alasan_formulir' => 'Anda belum melaksanakan kolokium, silahkan upload ulang formulir dengan jadwal baru',
            'alasan_bukti_sks' => 'Anda belum melaksanakan kolokium, silahkan upload ulang bukti sks',
            'alasan_bukti_spp' => 'Anda belum melaksanakan kolokium, silahkan upload ulang bukti spp',
            'alasan_bukti_kehadiran' => 'Anda belum melaksanakan kolokium, silahkan upload ulang bukti kehadiran',
        ]);

        $this->sendNotification($syarat->id_mahasiswa,
            '🔔 Anda belum melaksanakan Kolokium',
            'Silakan unggah ulang persyaratan kolokium dengan jadwal baru.',
            route('syaratkolokiummhs.create')
        );


         return redirect()->back()->with('error', 'BAP belum diterima. Mahasiswa harus mengunggah ulang persyaratan kolokium dengan jadwal terbaru');         
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

        return view('syaratkolokiummhs.moderator', compact('syaratKolokiummhs', 'nim', 'formulirPath', 'ext', 'listModerator'));
    }

    public function tambahModerator(Request $request, SyaratKolokiummhs $syaratKolokiummhs)
    {
        // Validasi input
        $request->validate([
            'moderator' => 'required|string|max:255'
        ]);

        $nim = $syaratKolokiummhs->mahasiswa->nim; 
        $nama = $syaratKolokiummhs->mahasiswa->nama;       
        $moderatorId = $request->moderator;

        $moderator = StaffDept::findOrFail($moderatorId)->nama;

        // Simpan ke database
        $syaratKolokiummhs->update([
            'id_moderator' => $moderatorId
        ]);   
        
        $this->sendNotification($syaratKolokiummhs->id_mahasiswa,
            '🔔 Moderator Ditentukan',            
            "Moderator <strong>{$moderator}</strong> telah ditetapkan untuk kolokium Anda.",
            route('kolokiummhs.show', $syaratKolokiummhs->kolokiummhs->id)          
        );

        
        return redirect()->back()->with('success', "Moderator <strong>{$moderator}</strong> berhasil ditambahkan untuk mahasiswa <strong>{$nama}</strong> (<strong>{$nim}</strong>).");
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

    private function sendNotification($userId, $title, $message, $redirect = null)
    {
        AppNotification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'redirect_url' => $redirect,
        ]);
    }
}
