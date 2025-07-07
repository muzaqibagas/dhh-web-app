<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Kurikulum::all();

        // Search
        $query = Kurikulum::query();
        if ($request->has('search')){
            $search = $request->search;
            $query->where('nama', 'like', "%$search%");
        }

        $data = $query->get();
        return view('kurikulum.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $jenjangs = Jenjang::all();
        $data = Kurikulum::all();
        return view('kurikulum.create', compact('users','jenjangs','data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_jenjang' => 'required|exists:jenjangs,id',
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $insert = Kurikulum::create($request->all());

        if ($insert) {
            return redirect()->route('kurikulum.index')->with('success', 'Berhasil disimpan.');
        } else {
            return back()->with('error', 'Gagal disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurikulum $kurikulum)
    {
        $data = $kurikulum;        
        return view('kurikulum.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurikulum $kurikulum)
    {
        $users = User::all();
        $jenjangs = Jenjang::all();        
        return view('kurikulum.edit', compact('users','jenjangs','kurikulum'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_jenjang' => 'required|exists:jenjangs,id',
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        
        $update = $kurikulum->update($request->all());

        if ($update)
            return redirect()->route('kurikulum.index')->with('success', 'Data berhasil diperbarui.');
        else
            return back()->with('error', 'Gagal memperbarui data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurikulum $kurikulum)
    {
         $delete = $kurikulum->delete();

        if ($delete)
            return redirect()->route('kurikulum.index')->with('success', 'Data berhasil dihapus.');
        else
            return back()->with('error', 'Gagal menghapus data.');
    }
}
