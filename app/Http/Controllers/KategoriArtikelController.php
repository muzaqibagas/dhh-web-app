<?php

namespace App\Http\Controllers;

use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class KategoriArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriArtikel = KategoriArtikel::all();
        return view('kategoriartikel.index', compact('kategoriArtikel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoriartikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $insert = KategoriArtikel::create([
            'nama' => $request->nama,
        ]);

        if ($insert)
            return redirect()->route('kategoriartikel.index')->with('success', 'Kategori Artikel Berhasil Disimpan.');
        else
            return back()->with('error', 'Kategori Artikel Gagal Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriArtikel $kategoriArtikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriArtikel $kategoriArtikel)
    {
        return view('kategoriartikel.edit', compact('kategoriArtikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriArtikel $kategoriArtikel)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $update = $kategoriArtikel->update([
            'nama' => $request->nama,
        ]);        


        if ($update)
            return redirect()->route('kategoriartikel.index')->with('success', 'Kategori Artikel Berhasil Diupdate.');
        else
            return back()->with('error', 'Kategori Artikel Gagal Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriArtikel $kategoriArtikel)
    {
        $delete = $kategoriArtikel->delete();

        if ($delete)
            return redirect()->route('kategoriartikel.index')->with('success', 'Kategori Artikel Berhasil Dihapus');
        else
            return back()->with('error', 'Kategori Artikel Gagal Dihapus');
    }
}