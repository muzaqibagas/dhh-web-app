<?php

namespace App\Http\Controllers;

use App\Models\StaffDept;
use Illuminate\Http\Request;

class StaffDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffdepts = StaffDept::all();
        return view('staffdept.index', compact('staffdepts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staffdept.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_divisi' => 'nullable|exists:divisis,id',
            'foto' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|string|max:255',
            'nip' => 'required|string|unique:staff_depts,nip',
            'jabatan' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'sinta' => 'nullable|string|max:255',
            'google_scholar' => 'nullable|string|max:255',
            'scopus' => 'nullable|string|max:255',
            'researchgate' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'minat_penelitian' => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
        ]);
        $insert = StaffDept::create($data);
        if ($insert)
            return redirect()->route('staffdept.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffDept $staffDept)
    {
        return view('staffdept.show', compact('staffDept'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffDept $staffDept)
    {
        return view('staffdept.edit', compact('staffDept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffDept $staffDept)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_divisi' => 'nullable|exists:divisis,id',
            'foto' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|string|max:255',
            'nip' => 'required|string|unique:staff_depts,nip,' . $staffDept->id,
            'jabatan' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'sinta' => 'nullable|string|max:255',
            'google_scholar' => 'nullable|string|max:255',
            'scopus' => 'nullable|string|max:255',
            'researchgate' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'minat_penelitian' => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
        ]);
        $update = $staffDept->update($data);
        if ($update)
            return redirect()->route('staffdept.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffDept $staffDept)
    {
        $staffDept->delete();
        return redirect()->route('staffdept.index');
    }
}
