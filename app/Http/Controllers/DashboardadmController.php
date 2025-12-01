<?php

namespace App\Http\Controllers;

use App\Models\Dashboardadm;
use App\Models\SyaratKolokiummhs;
use App\Models\SyaratSeminarmhs;
use App\Models\SyaratKomprehensifmhs;
use App\Models\Artikel;
use App\Models\Sdgs;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardadmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // parse filter tahun ajaran (contoh "2024/2025" atau "2024")
        $tahunAjaran = $request->input('tahun_ajaran');
        if ($tahunAjaran && preg_match('/^(\d{4})[\/\-](\d{4})$/', $tahunAjaran, $m)) {
            $start = Carbon::createFromDate((int)$m[1], 7, 1)->startOfDay();
            $end   = Carbon::createFromDate((int)$m[2], 6, 30)->endOfDay();
        } elseif ($tahunAjaran && preg_match('/^\d{4}$/', $tahunAjaran)) {
            $start = Carbon::createFromDate((int)$tahunAjaran, 1, 1)->startOfDay();
            $end   = Carbon::createFromDate((int)$tahunAjaran, 12, 31)->endOfDay();
        } else {
            // default = tahun kalender sekarang
            $start = Carbon::now()->startOfYear();
            $end   = Carbon::now()->endOfYear();
            $tahunAjaran = $start->year;
        }

        // helper closure supaya query konsisten
        $between = fn($query) => $query->whereBetween('created_at', [$start, $end]);

        // data pendaftar (menggunakan whereBetween)
        $jumlahKolokium = SyaratKolokiummhs::where('status', 'disetujui')->whereBetween('created_at', [$start, $end])->count();
        $jumlahSeminar   = SyaratSeminarmhs::where('status', 'disetujui')->whereBetween('created_at', [$start, $end])->count();
        $jumlahKompre    = SyaratKomprehensifmhs::where('status', 'disetujui')->whereBetween('created_at', [$start, $end])->count();

        // Status Lulus / Belum Lulus
        $lulusKolokium = SyaratKolokiummhs::where('bap', 'diterima')->whereBetween('created_at', [$start, $end])->count();
        $belumKolokium = SyaratKolokiummhs::whereIn('bap', ['belum_melaksanakan', 'ditolak'])->whereBetween('created_at', [$start, $end])->count();
        $lulusSeminar  = SyaratSeminarmhs::where('bap', 'diterima')->whereBetween('created_at', [$start, $end])->count();
        $belumSeminar  = SyaratSeminarmhs::whereIn('bap', ['belum_melaksanakan', 'ditolak'])->whereBetween('created_at', [$start, $end])->count();
        $lulusKompre   = SyaratKomprehensifmhs::where('bap', 'diterima')->whereBetween('created_at', [$start, $end])->count();
        $belumLulusKompre = SyaratKomprehensifmhs::whereIn('bap', ['belum_melaksanakan', 'ditolak'])->whereBetween('created_at', [$start, $end])->count();

        // grafik line per 12 bulan dimulai dari $start (iterasi 12 bulan)
        $trendKolokium = [];
        $trendSeminar  = [];
        $trendKompre   = [];

        for ($i = 0; $i < 12; $i++) {
            $mStart = $start->copy()->addMonths($i)->startOfMonth();
            $mEnd   = $mStart->copy()->endOfMonth();

            $trendKolokium[] = SyaratKolokiummhs::where('status', 'disetujui')->whereBetween('created_at', [$mStart, $mEnd])->count();
            $trendSeminar[]  = SyaratSeminarmhs::where('status', 'disetujui')->whereBetween('created_at', [$mStart, $mEnd])->count();
            $trendKompre[]   = SyaratKomprehensifmhs::where('status', 'disetujui')->whereBetween('created_at', [$mStart, $mEnd])->count();
        }

        // grafik donut
        $kolokiumDisetujui = SyaratKolokiummhs::where('status', 'disetujui')->whereBetween('created_at', [$start, $end])->count();
        $kolokiumDitolak   = SyaratKolokiummhs::where('status', 'ditolak')->whereBetween('created_at', [$start, $end])->count();
        $kolokiumPending   = SyaratKolokiummhs::where('status', 'pending')->whereBetween('created_at', [$start, $end])->count();

        $seminarDisetujui = SyaratSeminarmhs::where('status', 'disetujui')->whereBetween('created_at', [$start, $end])->count();
        $seminarDitolak   = SyaratSeminarmhs::where('status', 'ditolak')->whereBetween('created_at', [$start, $end])->count();
        $seminarPending   = SyaratSeminarmhs::where('status', 'pending')->whereBetween('created_at', [$start, $end])->count();

        $kompreDisetujui = SyaratKomprehensifmhs::where('status', 'disetujui')->whereBetween('created_at', [$start, $end])->count();
        $kompreDitolak   = SyaratKomprehensifmhs::where('status', 'ditolak')->whereBetween('created_at', [$start, $end])->count();
        $komprePending   = SyaratKomprehensifmhs::where('status', 'pending')->whereBetween('created_at', [$start, $end])->count();

        // ==== Artikel per SDGs ====        
        $sdgsList = Sdgs::all();        
        $sdgsColors = $sdgsList->map(fn($s) => $s->badgeColor());        
        $sdgsNames = $sdgsList->pluck('nama_sdgs');        
        $kategoriCount = $sdgsList->map(fn($s) => $s->artikel()->whereBetween('created_at', [$start, $end])->count());

        return view('dashboardadm.index', compact(
            'jumlahKolokium',
            'jumlahSeminar',
            'jumlahKompre',
            'lulusKolokium', 'lulusSeminar', 'lulusKompre',
            'belumKolokium', 'belumSeminar', 'belumLulusKompre',
            'trendKolokium',
            'trendSeminar',
            'trendKompre',
            'kolokiumDisetujui', 'kolokiumDitolak', 'kolokiumPending',
            'seminarDisetujui', 'seminarDitolak', 'seminarPending',
            'kompreDisetujui', 'kompreDitolak', 'komprePending',
            'sdgsList', 'sdgsColors', 'sdgsNames', 'kategoriCount',
            'tahunAjaran', // kirim nilai terpilih ke view
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
    public function show(Dashboardadm $dashboardadm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboardadm $dashboardadm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboardadm $dashboardadm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboardadm $dashboardadm)
    {
        //
    }
}
