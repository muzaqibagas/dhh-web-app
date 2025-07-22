<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidangs = Sidang::all();
        return view('sidang.index', compact('sidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('sidang.create', compact('ruangans', 'mahasiswas'));
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
            'judul_tugasakhir' => 'required|string|max:255',
        ]);
        $insert = Sidang::create($data);
        if ($insert)
            return redirect()->route('sidang.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sidang $sidang)
    {
        return view('sidang.show', compact('sidang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sidang $sidang)
    {
        $ruangans = Ruangan::all();
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('sidang.edit', compact('sidang', 'ruangans', 'mahasiswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sidang $sidang)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'id_mahasiswa' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',            
            'judul_tugasakhir' => 'required|string|max:255',
        ]);
        $update = $sidang->update($data);
        if ($update)
            return redirect()->route('sidang.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sidang $sidang)
    {
        $sidang->delete();
        return redirect()->route('sidang.index');
    }
}
