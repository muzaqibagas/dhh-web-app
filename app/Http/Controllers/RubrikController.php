<?php

namespace App\Http\Controllers;

use App\Models\Rubrik;
use Illuminate\Http\Request;

class RubrikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $query = Rubrik::query();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where('nama_kriteria', 'like', "%$search%");
        }    
        $rubriks = $query->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        return view('rubriks.index', compact('rubriks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rubriks = Rubrik::all();
        return view('rubriks.create', compact('rubriks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
            'jenis_sidang' => 'required|in:kolokium,seminar,komprehensif',
        ]);

        $insert = Rubrik::create([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_sidang' => $request->jenis_sidang,
        ]);

        if ($insert) {
            return redirect()->route('rubrik.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('rubrik.index')->with('error', 'Data gagal disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rubrik $rubrik)
    {
        return view('rubriks.show', compact('rubrik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rubrik $rubrik)
    {
        return view('rubriks.edit', compact('rubrik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rubrik $rubrik)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
            'jenis_sidang' => 'required|in:kolokium,seminar,komprehensif',
        ]);

        $rubrik->fill([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_sidang' => $request->jenis_sidang,
        ]);

        if (!$rubrik->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data.');
        }

        if ($rubrik->save()) {
            return redirect()->route('rubrik.index')->with('success', 'Data berhasil diperbarui.');
        } else {
            return back()->with('error', 'Data gagal diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rubrik $rubrik)
    {
        $rubrik->delete();
        return redirect()->route('rubrik.index')->with('success', 'Data berhasil dihapus.');    
    }
}
