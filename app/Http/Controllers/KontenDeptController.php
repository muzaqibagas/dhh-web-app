<?php

namespace App\Http\Controllers;

use App\Models\KontenDept;
use App\Models\StaffDept;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KontenDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konten = KontenDept::first();

        if ($konten) {
            // Jika sudah ada data, langsung arahkan ke halaman show
            return redirect()->route('konten-dept.show', $konten->id);
        } else {
            // Jika belum ada data, arahkan ke halaman create
            return redirect()->route('konten-dept.create');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existing = KontenDept::first();

        if ($existing) {            
            return redirect()->route('konten-dept.show', $existing->id)
                ->with('error', 'Konten Departemen sudah ada, silakan edit data yang ada.');
        }

        return view('konten-dept.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $existing = KontenDept::first();

        if ($existing) {
            return redirect()->route('konten-dept.show', $existing->id)->with('error', 'Konten Departemen sudah ada, silakan edit data yang ada.');
        }

        $data = $request->validate([            
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'kebijakanmutu' => 'nullable|string',
        ]);

        $insert = KontenDept::create($data);
        if ($insert)
            return redirect()->route('konten-dept.show', $insert->id)->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KontenDept $kontenDept)
    {
        return view('konten-dept.show', compact('kontenDept'));
    }

    public function sejarah(KontenDept $kontenDept)
    {
        $konten = KontenDept::first();

        $struktur = StaffDept::whereHas('kategoristaff', function($q){
            $q->where('nama', 'Struktur Organisasi');
        })->get();

        $dosen = StaffDept::whereHas('kategoristaff', function($q){
            $q->where('nama', 'Tenaga Pendidik/Dosen');
        })->get();

        $kependidikan = StaffDept::whereHas('kategoristaff', function($q){
            $q->where('nama', 'Tenaga Kependidikan');
        })->get();

        $divisiList = \App\Models\Divisi::with('staff')->get();

        return view('konten-dept.sejarah', compact('konten', 'kontenDept', 'struktur', 'dosen', 'kependidikan', 'divisiList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontenDept $kontenDept)
    {
        return view('konten-dept.edit', compact('kontenDept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontenDept $kontenDept)
    {
        $data = $request->validate([            
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'kebijakanmutu' => 'nullable|string',
        ]);

        $kontenDept->fill($data);
        if (!$kontenDept->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        $update = $kontenDept->update($data);
        if ($update)
            return redirect()->route('konten-dept.show', $kontenDept->id)->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontenDept $kontenDept)
    {
        $kontenDept->delete();
        return redirect()->route('konten-dept.index')->with('success', 'Data Konten Departemen berhasil dihapus!');
    }
}
