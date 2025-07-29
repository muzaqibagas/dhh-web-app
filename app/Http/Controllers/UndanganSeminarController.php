<?php

namespace App\Http\Controllers;

use App\Models\UndanganSeminar;
use Illuminate\Http\Request;

class UndanganSeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('undanganseminar.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UndanganSeminar $undanganSeminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UndanganSeminar $undanganSeminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UndanganSeminar $undanganSeminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UndanganSeminar $undanganSeminar)
    {
        //
    }
}
