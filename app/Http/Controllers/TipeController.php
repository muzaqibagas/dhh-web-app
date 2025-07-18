<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipes = Tipe::all();
        return view('tipe.index', compact('tipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $insert = Tipe::create($data);
        if ($insert)
            return redirect()->route('tipe.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tipe $tipe)
    {
        return view('tipe.show', compact('tipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tipe $tipe)
    {
        return view('tipe.edit', compact('tipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tipe $tipe)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $update = $tipe->update($data);
        if ($update)
            return redirect()->route('tipe.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tipe $tipe)
    {
        $tipe->delete();
        return redirect()->route('tipe.index');
    }
}
