<?php

namespace App\Http\Controllers;

use App\Models\UndanganSidang;
use Illuminate\Http\Request;

class UndanganSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('undangansidang.index');
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
    public function show(UndanganSidang $undanganSidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UndanganSidang $undanganSidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UndanganSidang $undanganSidang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UndanganSidang $undanganSidang)
    {
        //
    }
}
