<?php

namespace App\Http\Controllers;

use App\Models\AdmRecapData;
use Illuminate\Http\Request;

class AdmRecapDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recapdata.index');    
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
    public function show(AdmRecapData $admRecapData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmRecapData $admRecapData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmRecapData $admRecapData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdmRecapData $admRecapData)
    {
        //
    }
}
