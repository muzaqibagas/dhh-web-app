<?php

namespace App\Http\Controllers;

use App\Models\Profilemhs;
use Illuminate\Http\Request;

class ProfilemhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profilemhs.index');
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
    public function show(Profilemhs $profilemhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profilemhs $profilemhs)
    {
        return view('profilemhs.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profilemhs $profilemhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profilemhs $profilemhs)
    {
        //
    }
}
