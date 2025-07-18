<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class KategoriController extends Controller
{
    // GET /api/kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    // POST /api/kategori
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_tipe' => 'required|exists:tipes,id',
            'nama' => 'nullable|string|max:255',
        ]);
        $insert = Kategori::create($data);
        if ($insert)
            return redirect()->route('kategori.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    // GET /api/kategori/{id}
    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    // PUT /api/kategori/{id}
    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'id_tipe' => 'required|exists:tipes,id',
            'nama' => 'nullable|string|max:255',
        ]);
        $update = $kategori->update($data);
        if ($update)
            return redirect()->route('kategori.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    // DELETE /api/kategori/{id}
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index');
    }
}
