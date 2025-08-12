<?php

namespace App\Http\Controllers;

use App\Models\KategoriGaleri;
use Illuminate\Http\Request;

class KategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategorigaleri.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategorigaleri.create');
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
    public function show(KategoriGaleri $kategoriGaleri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriGaleri $kategoriGaleri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriGaleri $kategoriGaleri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriGaleri $kategoriGaleri)
    {
        //
    }
}
