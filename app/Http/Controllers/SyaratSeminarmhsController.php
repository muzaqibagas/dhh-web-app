<?php

namespace App\Http\Controllers;

use App\Models\SyaratSeminarmhs;
use Illuminate\Http\Request;

class SyaratSeminarmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('syaratseminarmhs.index');
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
    public function show(SyaratSeminarmhs $syaratSeminarmhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SyaratSeminarmhs $syaratSeminarmhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SyaratSeminarmhs $syaratSeminarmhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SyaratSeminarmhs $syaratSeminarmhs)
    {
        //
    }
}
