<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SyaratKolokiummhs;
use App\Models\SyaratSeminarmhs;
use App\Models\SyaratKomprehensifmhs;
use App\Models\Penilaian;
use App\Models\Dashboarddosen;
use App\Models\StaffNotification;
use Illuminate\Http\Request;

class DashboarddosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Auth::guard('staff')->user();

        $notifications = StaffNotification::where('staff_id', $dosen->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $dosen = Auth::guard('staff')->user();

        $kolokium = SyaratKolokiummhs::with(['mahasiswa','kolokiummhs', 'penilaian'])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {
                // Check if dosen is moderator or pembimbing
                return $item->id_moderator == $dosen->id || 
                       $item->kolokiummhs->id_pembimbing1 == $dosen->id || 
                       $item->kolokiummhs->id_pembimbing2 == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {
                $item->jenis_ujian = 'Kolokium';
                $item->tanggal_ujian = $item->kolokiummhs->tanggal ?? null;
                
                // Determine dosen role
                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = 'Moderator';
                }
                if ($item->kolokiummhs && ($item->kolokiummhs->id_pembimbing1 == $dosen->id || $item->kolokiummhs->id_pembimbing2 == $dosen->id)) {
                    $peran[] = 'Pembimbing';
                }

                $item->current_penilaian = Penilaian::where('id_syarat_kolokiummhs', $item->id)
                    ->where(function ($query) use ($dosen) {
                        $query->where('id_moderator', $dosen->id)
                              ->orWhere('id_pembimbing1', $dosen->id)
                              ->orWhere('id_pembimbing2', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);
                return $item;
            });

        $seminar = SyaratSeminarmhs::with(['mahasiswa','seminarmhs', 'penilaian'])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {
                // Check if dosen is moderator or pembimbing
                return $item->id_moderator == $dosen->id || 
                       $item->seminarmhs->id_pembimbing1 == $dosen->id || 
                       $item->seminarmhs->id_pembimbing2 == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {
                $item->jenis_ujian = 'Seminar Hasil';
                $item->tanggal_ujian = $item->seminarmhs->tanggal ?? null;
                
                // Determine dosen role
                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = 'Moderator';
                }
                if ($item->seminarmhs && ($item->seminarmhs->id_pembimbing1 == $dosen->id || $item->seminarmhs->id_pembimbing2 == $dosen->id)) {
                    $peran[] = 'Pembimbing';
                }

                $item->current_penilaian = Penilaian::where('id_syarat_seminarmhs', $item->id)
                    ->where(function ($query) use ($dosen) {
                        $query->where('id_moderator', $dosen->id)
                              ->orWhere('id_pembimbing1', $dosen->id)
                              ->orWhere('id_pembimbing2', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);
                return $item;
            });

        $kompre = SyaratKomprehensifmhs::with(['mahasiswa','komprehensifmhs', 'penilaian'])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {
                // Check if dosen is moderator, penguji, or pembimbing
                return $item->id_moderator == $dosen->id || 
                       $item->id_penguji == $dosen->id ||
                       $item->komprehensifmhs->id_pembimbing1 == $dosen->id || 
                       $item->komprehensifmhs->id_pembimbing2 == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {
                $item->jenis_ujian = 'Komprehensif';
                $item->tanggal_ujian = $item->komprehensifmhs->tanggal ?? null;
                
                // Determine dosen role
                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = 'Ketua Sidang';
                }
                if ($item->id_penguji == $dosen->id) {
                    $peran[] = 'Penguji';
                }
                if ($item->komprehensifmhs && ($item->komprehensifmhs->id_pembimbing1 == $dosen->id || $item->komprehensifmhs->id_pembimbing2 == $dosen->id)) {
                    $peran[] = 'Pembimbing';
                }

                $item->current_penilaian = Penilaian::where('id_syarat_komprehensifmhs', $item->id)
                    ->where(function ($query) use ($dosen) {
                        $query->where('id_moderator', $dosen->id)
                              ->orWhere('id_penguji', $dosen->id)
                              ->orWhere('id_pembimbing1', $dosen->id)
                              ->orWhere('id_pembimbing2', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);
                return $item;
            });

        $jadwal = $kolokium
            ->concat($seminar)
            ->concat($kompre)
            ->sortByDesc('tanggal_ujian');

        return view('dashboarddosen.index', compact(
            'notifications', 
            'jadwal',            
        ));
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
    public function show(Dashboarddosen $dashboarddosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboarddosen $dashboarddosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboarddosen $dashboarddosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboarddosen $dashboarddosen)
    {
        //
    }
}
