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
        $query = KategoriArtikel::query();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where('nama', 'like', "%$search%");
        }

        $kategoriArtikel = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();

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

        if ($insert) {
            return redirect()->route('kategoriartikel.index')->with('success', 'Kategori Artikel Berhasil Disimpan.');
        } else {
            return back()->with('error', 'Kategori Artikel Gagal Disimpan');
        }
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

        $kategoriArtikel->fill([
            'nama' => $request->nama,
        ]);

        if (! $kategoriArtikel->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        if ($kategoriArtikel->save()) {
            return redirect()->route('kategoriartikel.index')->with('success', 'Kategori Artikel Berhasil Diupdate.');
        } else {
            return back()->with('error', 'Kategori Artikel Gagal Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriArtikel $kategoriArtikel)
    {
        $delete = $kategoriArtikel->delete();

        if ($delete) {
            return redirect()->route('kategoriartikel.index')->with('success', 'Kategori Artikel Berhasil Dihapus');
        } else {
            return back()->with('error', 'Kategori Artikel Gagal Dihapus');
        }
    }
}
