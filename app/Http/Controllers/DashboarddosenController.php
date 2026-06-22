<?php

namespace App\Http\Controllers;

use App\Models\Dashboarddosen;
use App\Models\StaffNotification;
use App\Models\SyaratUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        // Ambil pendaftar yang relevan untuk dosen (tanpa memetakan properti untuk tabel)
        $items = SyaratUjian::with([
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
            });

            // Hitung statistik untuk kartu status
            // `scheduledCount` = jumlah pendaftar untuk kegiatan yang sudah memiliki
            // tanggal pelaksanaan dan jadwalnya berada di masa depan (upcoming)
            $scheduledCount = 0;
            $pendingCount = 0;
            $completedCount = 0;

            foreach ($items as $item) {
                $relasi = $item->jenis_ujian === 'kolokium' ? $item->kolokiummhs :
                          ($item->jenis_ujian === 'seminar' ? $item->seminarmhs :
                          $item->komprehensifmhs);

                $tanggal = $relasi->tanggal ?? null;
                if ($tanggal) {
                    try {
                        if (Carbon::parse($tanggal)->isFuture()) {
                            $scheduledCount++;
                        }
                    } catch (\Exception $e) {
                        // lewati tanggal yang tidak valid
                    }
                }

                // Hitung penilaian untuk dosen yang sedang login saja
                // Relasi penilaian sudah difilter berdasarkan dosen yang login.
                $penilaianDosen = $item->penilaian;
                $hasCompleted = $penilaianDosen->whereNotNull('nilai_akhir')->isNotEmpty();

                if ($penilaianDosen->isEmpty() || ! $hasCompleted) {
                    $pendingCount++;
                } else {
                    $completedCount++;
                }
            }

            return view('dashboarddosen.index', compact(
                    'notifications',
                    'scheduledCount',
                    'pendingCount',
                    'completedCount'
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
