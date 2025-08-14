<?php

namespace App\Http\Controllers;

use App\Models\KontenDept;
use Illuminate\Http\Request;

class KontenDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontens = KontenDept::all();
        return view('konten-dept.index', compact('kontens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('konten-dept.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $insert = KontenDept::create($data);
        if ($insert)
            return redirect()->route('kontendept.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KontenDept $kontenDept)
    {
        return view('konten-dept.show', compact('kontenDept'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontenDept $kontenDept)
    {
        return view('konten-dept.edit', compact('kontenDept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontenDept $kontenDept)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'kebijakanmutu' => 'nullable|string',
        ]);
        $update = $kontenDept->update($data);
        if ($update)
            return redirect()->route('konten-dept.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontenDept $kontenDept)
    {
        $kontenDept->delete();
        return redirect()->route('konten-dept.index');
    }
}
