<?php

namespace App\Http\Controllers;

use App\Models\UndanganKolokium;
use Illuminate\Http\Request;

class UndanganKolokiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('undangankolokium.index');
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
    public function show(UndanganKolokium $undanganKolokium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UndanganKolokium $undanganKolokium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UndanganKolokium $undanganKolokium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UndanganKolokium $undanganKolokium)
    {
        //
    }
}
