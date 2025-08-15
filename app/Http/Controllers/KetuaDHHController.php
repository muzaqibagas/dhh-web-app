<?php

namespace App\Http\Controllers;

use App\Models\KetuaDHH;
use Illuminate\Http\Request;

class KetuaDHHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ketuadhh.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ketuadhh.create');
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
    public function show(KetuaDHH $ketuaDHH)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KetuaDHH $ketuaDHH)
    {
        return view('ketuadhh.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KetuaDHH $ketuaDHH)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KetuaDHH $ketuaDHH)
    {
        //
    }
}
