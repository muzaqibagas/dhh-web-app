<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::all();
        return view('galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'tipe' => 'required|in:gambar,video',
            'video' => 'nullable|string|max:255',
            'gambar' => 'nullable|string|max:255',
        ]);
        $insert = Galeri::create($data);
        if ($insert)
            return redirect()->route('galeri.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'tipe' => 'required|in:gambar,video',
            'video' => 'nullable|string|max:255',
            'gambar' => 'nullable|string|max:255',
        ]);
        $update = $galeri->update($data);
        if ($update)
            return redirect()->route('galeri.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('galeri.index');
    }
}
