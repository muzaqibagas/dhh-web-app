<?php

namespace App\Http\Controllers;

use App\Models\KategoriKompetensi;
use Illuminate\Http\Request;

class KategoriKompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kompetensis = KategoriKompetensi::all();
        return view('kategorikompetensi.index', compact('kompetensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategorikompetensi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $insert = KategoriKompetensi::create($data);
        if ($insert)
            return redirect()->route('kategorikompetensi.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKompetensi $kategoriKompetensi)
    {
        return view('kategorikompetensi.show', compact('kategoriKompetensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKompetensi $kategoriKompetensi)
    {
        return view('kategorikompetensi.edit', compact('kategoriKompetensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriKompetensi $kategoriKompetensi)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $update = $kategoriKompetensi->update($data);
        if ($update)
            return redirect()->route('kategorikompetensi.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKompetensi $kategoriKompetensi)
    {
        $kategoriKompetensi->delete();
        return redirect()->route('kategorikompetensi.index');
    }
}
