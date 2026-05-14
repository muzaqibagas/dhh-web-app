<?php

namespace App\Http\Controllers;

use App\Models\Dashboardmhs;
use App\Models\Notification;
use App\Models\SyaratUjian;
use Illuminate\Http\Request;

class DashboardmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $notifications = Notification::where('user_id', $userId)
            ->latest()
            ->take(10)
            ->get();

        // 🔥 ambil semua syarat dalam 1 query
        $syarat = SyaratUjian::where('id_mahasiswa', $userId)->get();

        // 🔥 mapping berdasarkan jenis
        $kolokium = $syarat->where('jenis_ujian', 'kolokium')->first();
        $seminar = $syarat->where('jenis_ujian', 'seminar')->first();
        $komprehensif = $syarat->where('jenis_ujian', 'komprehensif')->first();

        return view('dashboardmhs.index', compact(
            'kolokium',
            'seminar',
            'komprehensif',
            'notifications'
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
