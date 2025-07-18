<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {          
        $artikels = Artikel::all();
        return view('artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'foto' => 'nullable|string|max:255',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);
        $insert = Artikel::create($data);
        if ($insert)
            return redirect()->route('artikel.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        return view('artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'foto' => 'nullable|string|max:255',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);
        $update = $artikel->update($data);
        if ($update)
            return redirect()->route('artikel.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('artikel.index');
    }
}
