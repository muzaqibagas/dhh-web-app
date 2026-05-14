<?php

namespace App\Http\Controllers;

use App\Models\jadwalTA;
use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Seminarmhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dosenId = Auth::guard('staff')->id();
        $search = $request->input('search');

        $kolokium = Kolokiummhs::with(['mahasiswa', 'ruangan', 'syaratUjianKolokium'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId)
                    ->orWhereHas('syaratUjianKolokium', function ($q) use ($dosenId) {
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
                    'status' => $item->syaratUjianKolokium?->status ?? '-',
                    'bap' => $item->syaratUjianKolokium?->bap ?? '-',
                    'id' => $item->id,
                    'route' => 'kolokium',
                ];
            });

        $seminar = Seminarmhs::with(['mahasiswa', 'ruangan', 'syaratUjianSeminar'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId)
                    ->orWhereHas('syaratUjianSeminar', function ($q) use ($dosenId) {
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
                    'status' => $item->syaratUjianSeminar?->status ?? '-',
                    'bap' => $item->syaratUjianSeminar?->bap ?? '-',
                    'id' => $item->id,
                    'route' => 'seminar',
                ];
            });

        $kompre = Komprehensifmhs::with(['mahasiswa', 'syaratUjianKomprehensif'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId)
                    ->orWhereHas('syaratUjianKomprehensif', function ($q) use ($dosenId) {
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
                    'ruangan' => $item->syaratUjianKomprehensif->ruangan ?? '-',
                    'status' => $item->syaratUjianKomprehensif?->status ?? '-',
                    'bap' => $item->syaratUjianKomprehensif?->bap ?? '-',
                    'id' => $item->id,
                    'route' => 'komprehensif',
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
