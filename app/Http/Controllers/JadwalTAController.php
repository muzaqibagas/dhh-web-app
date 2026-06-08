<?php

namespace App\Http\Controllers;

use App\Models\jadwalTA;
use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Seminarmhs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dosen = Auth::guard('staff')->user();
        $search = $request->input('search');

        Log::warning('Percobaan search', [
            'user' => $dosen->nama ?? 'Unknown',
            'search' => $search,
            'ip' => $request->ip(),
        ]);

        $kolokium = Kolokiummhs::with(['mahasiswa', 'ruangan', 'syaratUjianKolokium'])
            ->where(function ($q) use ($dosen) {
                $q->where('id_pembimbing1', $dosen->id)
                    ->orWhere('id_pembimbing2', $dosen->id)
                    ->orWhereHas('syaratUjianKolokium', function ($q) use ($dosen) {
                        $q->where('id_moderator', $dosen->id);
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
            ->where(function ($q) use ($dosen) {
                $q->where('id_pembimbing1', $dosen->id)
                    ->orWhere('id_pembimbing2', $dosen->id)
                    ->orWhereHas('syaratUjianSeminar', function ($q) use ($dosen) {
                        $q->where('id_moderator', $dosen->id);
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
            ->where(function ($q) use ($dosen) {
                $q->where('id_pembimbing1', $dosen->id)
                    ->orWhere('id_pembimbing2', $dosen->id)
                    ->orWhereHas('syaratUjianKomprehensif', function ($q) use ($dosen) {
                        $q->where('id_moderator', $dosen->id);
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

        $perPage = 10;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $jadwals->forPage($page, $perPage)->values();

        $paginatedJadwals = new LengthAwarePaginator(
            $currentItems,
            $jadwals->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('jadwalta.index', ['jadwals' => $paginatedJadwals]);
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
