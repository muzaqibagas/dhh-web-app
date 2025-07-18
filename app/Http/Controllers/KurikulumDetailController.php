<?php

namespace App\Http\Controllers;

use App\Models\KurikulumDetail;
use Illuminate\Http\Request;

class KurikulumDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = KurikulumDetail::all();
        return view('kurikulumdetail.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kurikulumdetail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_smk' => 'required|exists:smks,id',
            'id_kategorikompetensi' => 'required|exists:kategori_kompetensis,id',
            'deskripsi' => 'nullable|string',
        ]);
        $insert = KurikulumDetail::create($data);
        if ($insert)
            return redirect()->route('kurikulumdetail.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KurikulumDetail $kurikulumDetail)
    {
        return view('kurikulumdetail.show', compact('kurikulumDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurikulumDetail $kurikulumDetail)
    {
        return view('kurikulumdetail.edit', compact('kurikulumDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KurikulumDetail $kurikulumDetail)
    {
        $data = $request->validate([
            'id_smk' => 'required|exists:smks,id',
            'id_kategorikompetensi' => 'required|exists:kategori_kompetensis,id',
            'deskripsi' => 'nullable|string',
        ]);
        $update = $kurikulumDetail->update($data);
        if ($update)
            return redirect()->route('kurikulumdetail.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurikulumDetail $kurikulumDetail)
    {
        $kurikulumDetail->delete();
        return redirect()->route('kurikulumdetail.index');
    }
}
