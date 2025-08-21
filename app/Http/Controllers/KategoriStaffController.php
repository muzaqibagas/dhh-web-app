<?php

namespace App\Http\Controllers;

use App\Models\AcaraAkademik;
use App\Models\Artikel;
use App\Models\Divisi;
use App\Models\Galeri;
use App\Models\jenjang;
use App\Models\Kategori;
use App\Models\KategoriStaff;
use App\Models\Kolokium;
use App\Models\KontenDept;
use App\Models\Review;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\Seminar;
use App\Models\Sidang;
use App\Models\StaffDept; 
use App\Models\Undangan; 
use App\Models\user;
use Illuminate\Http\Request;

class KategoriStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriStaffs = KategoriStaff::all();

        $query = KategoriStaff::query();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where('nama', 'like', "%$search%");
        }
        $kategoriStaffs = $query->get();
        return view('kategoristaff.index', compact('kategoriStaffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriStaffs = KategoriStaff::all();
        return view('kategoristaff.create', compact('kategoriStaffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $insert = KategoriStaff::create([
            'nama' => $request->nama,        
        ]);

        if ($insert) {
            return redirect()->route('kategoristaff.index')->with('success', 'Kategori Staff berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan Kategori Staff.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriStaff $kategoriStaff)
    {
        return view('kategoristaff.show', compact('kategoriStaff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriStaff $kategoriStaff)
    {
        return view('kategoristaff.edit', compact('kategoriStaff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriStaff $kategoriStaff)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $update = $kategoriStaff->update([
            'nama' => $request->nama,
        ]);

        if ($update) {
            return redirect()->route('kategoristaff.index')->with('success', 'Kategori Staff berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui Kategori Staff.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriStaff $kategoriStaff)
    {
        $kategoriStaff->delete();
        return redirect()->route('kategoristaff.index')->with('success', 'Kategori Staff berhasil dihapus.');
    }
}
