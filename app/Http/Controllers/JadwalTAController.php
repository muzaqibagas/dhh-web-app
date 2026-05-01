<?php

namespace App\Http\Controllers;

use App\Models\jadwalTA;
use App\Models\Notification;
use App\Models\Kolokiummhs;
use App\Models\Seminarmhs;
use App\Models\Komprehensifmhs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dosenId = Auth::guard('staff')->id();
        $search = $request->input('search');        

        $kolokium = Kolokiummhs::with(['mahasiswa','ruangan','syaratKolokium'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_pembimbing1', $dosenId)
                ->orWhere('id_pembimbing2', $dosenId)
                ->orWhereHas('syaratKolokium', function ($q) use ($dosenId) {
                    $q->where('id_moderator', $dosenId);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(nama) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('LOWER(nim) LIKE ?', ["%{$search}%"]);
                    });
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->mahasiswa->nama ?? '-',
                    'nim' => $item->mahasiswa->nim ?? '-',
                    'jenis' => 'Kolokium',
                    'tanggal' => $item->tanggal,
                    'mulai' => $item->waktu_mulai,
                    'selesai' => $item->waktu_selesai,
                    'ruangan' => $item->ruangan->nama ?? '-',
                    'status' => $item->syaratKolokium->status ?? '-',                    
                    'bap' => $item->syaratKolokium->bap ?? '-', 
                    'id' => $item->id,
                    'route' => 'kolokium'
                ];
            });

        $seminar = Seminarmhs::with(['mahasiswa','ruangan','syaratSeminar'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_pembimbing1', $dosenId)
                ->orWhere('id_pembimbing2', $dosenId)            
                ->orWhereHas('syaratSeminar', function ($q) use ($dosenId) {
                    $q->where('id_moderator', $dosenId);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(nama) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('LOWER(nim) LIKE ?', ["%{$search}%"]);
                    });
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->mahasiswa->nama ?? '-',
                    'nim' => $item->mahasiswa->nim ?? '-',
                    'jenis' => 'Seminar',
                    'tanggal' => $item->tanggal,
                    'mulai' => $item->waktu_mulai,
                    'selesai' => $item->waktu_selesai,
                    'ruangan' => $item->ruangan->nama ?? '-',
                    'status' => $item->syaratSeminar->status ?? '-',                    
                    'bap' => $item->syaratSeminar->bap ?? '-', 
                    'id' => $item->id,
                    'route' => 'seminar'
                ];
            });

        $kompre = Komprehensifmhs::with(['mahasiswa','ruangan','syaratKomprehensif'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_pembimbing1', $dosenId)
                ->orWhere('id_pembimbing2', $dosenId)            
                ->orWhereHas('syaratKomprehensif', function ($q) use ($dosenId) {
                    $q->where('id_moderator', $dosenId);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(nama) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('LOWER(nim) LIKE ?', ["%{$search}%"]);
                    });
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->mahasiswa->nama ?? '-',
                    'nim' => $item->mahasiswa->nim ?? '-',
                    'jenis' => 'Komprehensif',
                    'tanggal' => $item->tanggal,
                    'mulai' => $item->waktu_mulai,
                    'selesai' => $item->waktu_selesai,
                    'ruangan' => $item->ruangan->nama ?? '-',
                    'status' => $item->syaratKomprehensif->status ?? '-',                    
                    'bap' => $item->syaratKomprehensif->bap ?? '-', 
                    'id' => $item->id,
                    'route' => 'komprehensif'
                ];
            });        
        $jadwals = $kolokium
            ->concat($seminar)
            ->concat($kompre)
            ->sortBy('tanggal')
            ->values();        

        return view('jadwalta.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(jadwalTA $jadwalTA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jadwalTA $jadwalTA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jadwalTA $jadwalTA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jadwalTA $jadwalTA)
    {
        //
    }
}
