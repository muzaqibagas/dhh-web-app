<?php

namespace App\Http\Controllers;

use App\Models\AcaraAkademik;
use Illuminate\Http\Request;

class AcaraAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            // field lain...
        ]);
        AcaraAkademik::create($data);
        return redirect()->route('acara-akademik.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcaraAkademik $acaraAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcaraAkademik $acaraAkademik)
    {
        //
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
            // field lain...
        ]);
        $acaraAkademik->update($data);
        return redirect()->route('acara-akademik.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcaraAkademik $acaraAkademik)
    {
        $acaraAkademik->delete();
        return redirect()->route('acara-akademik.index');
    }
}
