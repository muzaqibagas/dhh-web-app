<?php

namespace App\Http\Controllers;

use App\Models\Kolokium;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class KolokiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolokiums = Kolokium::all();
        return view('kolokium.index', compact('kolokiums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('kolokium.create', compact('ruangans', 'mahasiswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',            
            'judul_kolokium' => 'required|string|max:255',
        ]);
        $insert = Kolokium::create($data);
        if ($insert)
            return redirect()->route('kolokium.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kolokium $kolokium)
    {
        return view('kolokium.show', compact('kolokium'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kolokium $kolokium)
    {
        $ruangans = Ruangan::all();
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('kolokium.edit', compact('kolokium', 'ruangans', 'mahasiswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kolokium $kolokium)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id', 
            'tanggal' => 'required|date',
            'waktu' => 'required',            
            'judul_kolokium' => 'required|string|max:255',
        ]);
        $update = $kolokium->update($data);
        if ($update)
            return redirect()->route('kolokium.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kolokium $kolokium)
    {
        $kolokium->delete();
        return redirect()->route('kolokium.index');
    }
}
