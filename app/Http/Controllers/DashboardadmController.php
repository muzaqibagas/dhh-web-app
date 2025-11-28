<?php

namespace App\Http\Controllers;

use App\Models\Dashboardadm;
use App\Models\SyaratKolokiummhs;
use App\Models\SyaratSeminarmhs;
use App\Models\SyaratKomprehensifmhs;
use App\Models\Artikel;
use App\Models\Sdgs;
use Illuminate\Http\Request;

class DashboardadmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // data pendaftar
        $jumlahKolokium = SyaratKolokiummhs::where('status', 'disetujui')->count();
        $jumlahSeminar = SyaratSeminarmhs::where('status', 'disetujui')->count();
        $jumlahKompre = SyaratKomprehensifmhs::where('status', 'disetujui')->count();
        // Status Lulus / Belum Lulus Komprehensif
        $lulusKolokium = SyaratKolokiummhs::where('bap', 'diterima')->count();
        $belumKolokium = SyaratKolokiummhs::whereIn('bap', ['belum_melaksanakan', 'ditolak'])->count();        
        $lulusSeminar = SyaratSeminarmhs::where('bap', 'diterima')->count();
        $belumSeminar = SyaratSeminarmhs::whereIn('bap', ['belum_melaksanakan', 'ditolak'])->count();        
        $lulusKompre = SyaratKomprehensifmhs::where('bap', 'diterima')->count();
        $belumLulusKompre = SyaratKomprehensifmhs::whereIn('bap', ['belum_melaksanakan', 'ditolak'])->count();

        //grafik line pendaftar
        $trendKolokium = [];
        $trendSeminar  = [];
        $trendKompre   = [];
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {

            $trendKolokium[] = SyaratKolokiummhs::where('status', 'disetujui')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $bulan)
                ->count();

            $trendSeminar[] = SyaratSeminarmhs::where('status', 'disetujui')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $bulan)
                ->count();

            $trendKompre[] = SyaratKomprehensifmhs::where('status', 'disetujui')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $bulan)
                ->count();
        }

        // grafik donut
        $kolokiumDisetujui = SyaratKolokiummhs::where('status', 'disetujui')->count();
        $kolokiumDitolak = SyaratKolokiummhs::whereColumn('updated_at', '!=', 'created_at')
            ->count();        
        $kolokiumPending = SyaratKolokiummhs::where('status', 'pending')->count();

        $seminarDisetujui = SyaratSeminarmhs::where('status', 'disetujui')->count();
        $seminarDitolak = SyaratSeminarmhs::whereColumn('updated_at', '!=', 'created_at')
            ->count();
        $seminarPending = SyaratSeminarmhs::where('status', 'pending')->count();

        $kompreDisetujui = SyaratKomprehensifmhs::where('status', 'disetujui')->count();
        $kompreDitolak = SyaratKomprehensifmhs::whereColumn('updated_at', '!=', 'created_at')
            ->count();
        $komprePending = SyaratKomprehensifmhs::where('status', 'pending')->count();

        // ==== Artikel per SDGs ====        
        $sdgsList = Sdgs::all();        
        $sdgsColors = $sdgsList->map(fn($s) => $s->badgeColor());        
        $sdgsNames = $sdgsList->pluck('nama_sdgs');        
        $kategoriCount = $sdgsList->map(fn($s) => $s->artikel()->count());

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
