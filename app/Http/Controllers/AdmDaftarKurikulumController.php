<?php

namespace App\Http\Controllers;

use App\Models\AdmDaftarKurikulum;
use Illuminate\Http\Request;

class AdmDaftarKurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admdaftarkurikulum.index');
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
    public function show(AdmDaftarKurikulum $admDaftarKurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmDaftarKurikulum $admDaftarKurikulum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmDaftarKurikulum $admDaftarKurikulum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdmDaftarKurikulum $admDaftarKurikulum)
    {
        //
    }
}
