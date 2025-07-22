<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seminars = Seminar::all();
        return view('seminar.index', compact('seminars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        $users = User::where('role', 'mahasiswa')->get();
        return view('seminar.create', compact('ruangans', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
            'judul_seminar' => 'required|string|max:255',
        ]);
        $insert = Seminar::create($data);
        if ($insert)
            return redirect()->route('seminar.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seminar $seminar)
    {
        return view('seminar.show', compact('seminar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seminar $seminar)
    {
        return view('seminar.edit', compact('seminar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seminar $seminar)
    {
        $data = $request->validate([
            'id_ruangan' => 'required|exists:ruangans,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
            'judul_seminar' => 'required|string|max:255',
        ]);
        $update = $seminar->update($data);
        if ($update)
            return redirect()->route('seminar.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminar $seminar)
    {
        $seminar->delete();
        return redirect()->route('seminar.index');
    }
}
