<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matakuliahs = MataKuliah::all();
        return view('matakuliah.index', compact('matakuliahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'kode' => 'required|string|unique:mata_kuliahs,kode',
            'nama' => 'nullable|string|max:255',
            'sks' => 'nullable|integer',
            'prasyarat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $insert = MataKuliah::create($data);
        if ($insert)
            return redirect()->route('matakuliah.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah)
    {
        return view('matakuliah.show', compact('mataKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        return view('matakuliah.edit', compact('mataKuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $data = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'kode' => 'required|string|unique:mata_kuliahs,kode,' . $mataKuliah->id,
            'nama' => 'nullable|string|max:255',
            'sks' => 'nullable|integer',
            'prasyarat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $update = $mataKuliah->update($data);
        if ($update)
            return redirect()->route('matakuliah.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return redirect()->route('matakuliah.index');
    }
}
