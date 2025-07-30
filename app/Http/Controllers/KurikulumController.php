<?php

namespace App\Http\Controllers;

use App\Models\AcaraAkademik;
use App\Models\Artikel;
use App\Models\Divisi;
use App\Models\Galeri;
use App\Models\jenjang;
use App\Models\Kategori;
use App\Models\KategoriKompetensi;
use App\Models\Kolokium;
use App\Models\KontenDept;
use App\Models\Kurikulum;
use App\Models\KurikulumDetail;
use App\Models\Matakuliah;
use App\Models\Pembimbing;
use App\Models\Review;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\Seminar;
use App\Models\Sidang;
use App\Models\Smk;
use App\Models\StaffDept; 
use App\Models\Tipe; 
use App\Models\Undangan; 
use App\Models\user;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kurikulums = Kurikulum::all();

        // Search
        $query = Kurikulum::query();
        if ($request->has('search')){
            $search = $request->search;
            $query->where('nama', 'like', "%$search%");
        }

        $data = $query->get();
        return view('kurikulum.index', compact('kurikulums'));

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
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),            
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
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),            
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
