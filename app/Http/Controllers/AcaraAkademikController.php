<?php

namespace App\Http\Controllers;

use App\Models\AcaraAkademik;
use App\Models\user;
use App\Models\StaffDept;
use App\Models\Kolokium;
use App\Models\Seminar;
use App\Models\Sidang;  
use Illuminate\Http\Request;

class AcaraAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $acaras = AcaraAkademik::with(['id_mahasiswa', 'id_staffdept', 'id_kolokium', 'id_seminar', 'id_sidang'])->get();
        return view('acaraakademik.index', compact('acaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kolokiums = Kolokium::with(['mahasiswa', 'ruangan'])->get();
        $seminars = Seminar::with(['mahasiswa', 'ruangan'])->get();
        $sidangs = Sidang::with(['mahasiswa', 'ruangan'])->get();
        $staffdepts = StaffDept::all();

        return view('acaraakademik.create', compact('kolokiums', 'seminars', 'sidangs', 'staffdepts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mahasiswa' => 'required|exists:users,id',
            'id_staffdept' => 'required|exists:staff_depts,id',
            'id_kolokium' => 'nullable|exists:kolokiums,id',
            'id_seminar' => 'required|exists:seminars,id',
            'id_sidang' => 'required|exists:sidangs,id',            
        ]);
        $insert = AcaraAkademik::create($data);
        if ($insert)
            return redirect()->route('acara-akademik.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcaraAkademik $acaraAkademik)
    {
        return view('acaraakademik.show', compact('acaraAkademik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcaraAkademik $acaraAkademik)
    {
        return view('acaraakademik.edit', compact('acaraAkademik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcaraAkademik $acaraAkademik)
    {
        $data = $request->validate([
            'id_mahasiswa' => 'required|exists:users,id',
            'id_staffdept' => 'required|exists:staff_depts,id',
            'id_kolokium' => 'nullable|exists:kolokiums,id',
            'id_seminar' => 'required|exists:seminars,id',
            'id_sidang' => 'required|exists:sidangs,id',
        ]);
        $update = $acaraAkademik->update($data);
        if ($update)
            return redirect()->route('acaraakademik.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcaraAkademik $acaraAkademik)
    {
        $acaraAkademik->delete();
        return redirect()->route('acaraakademik.index');
    }
}
