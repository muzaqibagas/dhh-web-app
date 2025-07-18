<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembimbings = Pembimbing::all();
        return view('pembimbing.index', compact('pembimbings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembimbing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mahasiswa' => 'required|exists:users,id',
            'id_staffdept' => 'required|exists:staff_depts,id',
        ]);
        $insert = Pembimbing::create($data);
        if ($insert)
            return redirect()->route('pembimbing.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembimbing $pembimbing)
    {
        return view('pembimbing.show', compact('pembimbing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembimbing $pembimbing)
    {
        return view('pembimbing.edit', compact('pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembimbing $pembimbing)
    {
        $data = $request->validate([
            'id_mahasiswa' => 'required|exists:users,id',
            'id_staffdept' => 'required|exists:staff_depts,id',
        ]);
        $update = $pembimbing->update($data);
        if ($update)
            return redirect()->route('pembimbing.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembimbing $pembimbing)
    {
        $pembimbing->delete();
        return redirect()->route('pembimbing.index');
    }
}
