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
        $query = KategoriGaleri::query();        
        if (request()->has('search')){
            $search = request()->search;
            $query->where('nama', 'like', "%$search%");
        }
        $kategoriGaleri = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('kategorigaleri.index', compact('kategoriGaleri'));
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
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $insert = KategoriGaleri::create([
            'nama' => $request->nama,
        ]);

        if ($insert)
            return redirect()->route('kategorigaleri.index')->with('success', 'Kategori Galeri Berhasil Disimpan.');
        else
            return back()->with('error', 'Kategori Galeri Gagal Disimpan');
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
        return view('kategorigaleri.edit', compact('kategoriGaleri'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, KategoriGaleri $kategoriGaleri)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // cek apakah ada perubahan data
        if ($kategoriGaleri->nama === $request->nama) {
            return redirect()->route('kategorigaleri.index')->with('info', 'Tidak ada perubahan data yang disimpan.');
        }

        $update = $kategoriGaleri->update([
            'nama' => $request->nama,
        ]);    
        
        $kategoriGaleri->fill([
            'nama' => $request->nama,
        ]);

        if (!$kategoriGaleri->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        if ($update)
            return redirect()->route('kategorigaleri.index')->with('success', 'Kategori Galeri Berhasil Diupdate.');
        else
            return back()->with('error', 'Kategori Galeri Gagal Diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriGaleri $kategoriGaleri)
    {
        $delete = $kategoriGaleri->delete();

        if ($delete)
            return redirect()->route('kategorigaleri.index')->with('success', 'Kategori Galeri Berhasil Dihapus');
        else
            return back()->with('error', 'Kategori Galeri Gagal Dihapus');
    }
}