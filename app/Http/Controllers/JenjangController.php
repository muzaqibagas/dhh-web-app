<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {        
        $data = Jenjang::all();

        // Search
        $query = Jenjang::query();                
        if ($request->has('search')){
            $search = $request->search;
            $query->where('nama', 'like', "%$search%");
        }

        $data = $query->get();
        return view('jenjang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Jenjang::all();
        return view('jenjang.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([            
            'nama' => 'required|string|max:255',
        ]);

        $insert = Jenjang::create($request->all());

        if ($insert) 
            return redirect()->route('jenjang.index')->with('success', 'Berhasil disimpan.');
        else 
            return back()->with('error', 'Gagal disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenjang $jenjang)
    {                
        $data = $jenjang;        
        return view('jenjang.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenjang $jenjang)
    {                
        return view('jenjang.edit', compact('jenjang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenjang $jenjang)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        
        $update = $jenjang->update($request->all());

        if ($update)
            return redirect()->route('jenjang.index')->with('success', 'Data berhasil diperbarui.');
        else
            return back()->with('error', 'Gagal memperbarui data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenjang $jenjang)
    {
        $delete = $jenjang->delete();

        if ($delete)
            return redirect()->route('jenjang.index')->with('success', 'Data berhasil dihapus.');
        else
            return back()->with('error', 'Gagal menghapus data.');
    }
}