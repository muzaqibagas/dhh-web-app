<?php

namespace App\Http\Controllers;

use App\Models\Smk;
use Illuminate\Http\Request;

class SmkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smks = Smk::all();
        return view('smk.index', compact('smks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('smk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_jenjang' => 'required|exists:jenjangs,id',
            'id_semester' => 'required|exists:semesters,id',
            'id_matakuliah' => 'required|exists:mata_kuliahs,id',
        ]);
        $insert = Smk::create($data);
        if ($insert)
            return redirect()->route('smk.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Smk $smk)
    {
        return view('smk.show', compact('smk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Smk $smk)
    {
        return view('smk.edit', compact('smk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Smk $smk)
    {
        $data = $request->validate([
            'id_jenjang' => 'required|exists:jenjangs,id',
            'id_semester' => 'required|exists:semesters,id',
            'id_matakuliah' => 'required|exists:mata_kuliahs,id',
        ]);
        $update = $smk->update($data);
        if ($update)
            return redirect()->route('smk.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Smk $smk)
    {
        $smk->delete();
        return redirect()->route('smk.index');
    }
}
