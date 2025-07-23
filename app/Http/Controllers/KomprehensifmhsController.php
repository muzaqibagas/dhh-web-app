<?php

namespace App\Http\Controllers;

use App\Models\Komprehensifmhs;
use Illuminate\Http\Request;

class KomprehensifmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('komprehensifmhs.index');
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
    public function show(Komprehensifmhs $komprehensifmhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komprehensifmhs $komprehensifmhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komprehensifmhs $komprehensifmhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komprehensifmhs $komprehensifmhs)
    {
        //
    }
}
