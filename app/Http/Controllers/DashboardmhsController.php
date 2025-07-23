<?php

namespace App\Http\Controllers;

use App\Models\Dashboardmhs;
use Illuminate\Http\Request;

class DashboardmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboardmhs.index');
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
