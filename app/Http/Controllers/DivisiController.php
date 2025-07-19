<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisis = Divisi::all();
        return view('divisi.index', compact('divisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $insert = Divisi::create($data);
        if ($insert)
            return redirect()->route('divisi.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        return view('divisi.show', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisi $divisi)
    {
        return view('divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisi $divisi)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $update = $divisi->update($data);
        if ($update)
            return redirect()->route('divisi.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return redirect()->route('divisi.index');
    }
}
