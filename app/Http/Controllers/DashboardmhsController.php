<?php

namespace App\Http\Controllers;

use App\Models\Dashboardmhs;
use App\Models\SyaratKolokiummhs;
use App\Models\SyaratSeminarmhs;
use App\Models\SyaratKomprehensifmhs;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $kolokium = SyaratKolokiummhs::where('id_mahasiswa', auth()->id())->first();
        $seminar = SyaratSeminarmhs::where('id_mahasiswa', auth()->id())->first();
        $komprehensif = SyaratKomprehensifmhs::where('id_mahasiswa', auth()->id())->first();
            
        return view('dashboardmhs.index', compact('kolokium', 'seminar', 'komprehensif', 'notifications'));
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
    public function show(Dashboardmhs $dashboardmhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboardmhs $dashboardmhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboardmhs $dashboardmhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboardmhs $dashboardmhs)
    {
        //
    }
}
