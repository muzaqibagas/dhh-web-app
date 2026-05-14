<?php

namespace App\Http\Controllers;

use App\Models\Dashboarddosen;
use App\Models\StaffNotification;
use App\Models\SyaratUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $data = SyaratUjian::with([
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
            'penilaian' => function ($q) use ($dosen) {
                $q->where(function ($query) use ($dosen) {
                    $query->where('id_moderator', $dosen->id)
                        ->orWhere('id_pembimbing1', $dosen->id)
                        ->orWhere('id_pembimbing2', $dosen->id)
                        ->orWhere('id_penguji', $dosen->id);
                });
            },
        ])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {

                $relasi = $item->jenis_ujian === 'kolokium' ? $item->kolokiummhs :
                          ($item->jenis_ujian === 'seminar' ? $item->seminarmhs :
                          $item->komprehensifmhs);

                if (! $relasi) {
                    return false;
                }

                return
                    $item->id_moderator == $dosen->id ||
                    ($relasi->id_pembimbing1 ?? null) == $dosen->id ||
                    ($relasi->id_pembimbing2 ?? null) == $dosen->id ||
                    ($item->id_penguji ?? null) == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {

                $relasi = $item->jenis_ujian === 'kolokium' ? $item->kolokiummhs :
                          ($item->jenis_ujian === 'seminar' ? $item->seminarmhs :
                          $item->komprehensifmhs);

                if (! $relasi) {
                    return null;
                }

                $item->tanggal_ujian = $relasi->tanggal ?? null;

                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = $item->jenis_ujian === 'komprehensif' ? 'Ketua Sidang' : 'Moderator';
                }
                if (($relasi->id_pembimbing1 ?? null) == $dosen->id ||
                    ($relasi->id_pembimbing2 ?? null) == $dosen->id) {
                    $peran[] = 'Pembimbing';
                }
                if (($item->id_penguji ?? null) == $dosen->id) {
                    $peran[] = 'Penguji';
                }

                $item->current_penilaian = $item->penilaian->where(function ($query) use ($dosen) {
                    $query->where('id_moderator', $dosen->id)
                        ->orWhere('id_pembimbing1', $dosen->id)
                        ->orWhere('id_pembimbing2', $dosen->id)
                        ->orWhere('id_penguji', $dosen->id);
                })->first();
                $item->peran_dosen = implode(', ', $peran);

                return $item;
            })
            ->filter()
            ->sortByDesc('tanggal_ujian');

        return view('dashboarddosen.index', compact(
            'notifications',
            'data',
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
