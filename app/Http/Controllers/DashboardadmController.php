<?php

namespace App\Http\Controllers;

use App\Models\Dashboardadm;
use Illuminate\Http\Request;

class DashboardadmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboardadm.index');
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
