<?php

namespace App\Http\Controllers;

use App\Models\Undangan;
use Illuminate\Http\Request;

class UndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $undangans = Undangan::all();
        return view('undangan.index', compact('undangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('undangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_acara_akademik' => 'required|exists:acara_akademiks,id',
            'id_pembimbing' => 'required|exists:pembimbings,id',
        ]);
        $insert = Undangan::create($data);
        if ($insert)
            return redirect()->route('undangan.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Undangan $undangan)
    {
        return view('undangan.show', compact('undangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Undangan $undangan)
    {
        return view('undangan.edit', compact('undangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Undangan $undangan)
    {
        $data = $request->validate([
            'id_acara_akademik' => 'required|exists:acara_akademiks,id',
            'id_pembimbing' => 'required|exists:pembimbings,id',
        ]);
        $update = $undangan->update($data);
        if ($update)
            return redirect()->route('undangan.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Undangan $undangan)
    {
        $undangan->delete();
        return redirect()->route('undangan.index');
    }
}
