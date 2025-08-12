<?php

namespace App\Http\Controllers;

use App\Models\KontenJenjang;
use Illuminate\Http\Request;

class KontenJenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kontenjenjang.index');
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
    public function show(KontenJenjang $kontenJenjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontenJenjang $kontenJenjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontenJenjang $kontenJenjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontenJenjang $kontenJenjang)
    {
        //
    }
}
