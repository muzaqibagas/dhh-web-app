<?php

namespace App\Http\Controllers;

use App\Models\Loginmhs;
use Illuminate\Http\Request;

class LoginmhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loginmhs.index');
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
    public function show(Loginmhs $loginmhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loginmhs $loginmhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loginmhs $loginmhs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loginmhs $loginmhs)
    {
        //
    }
}
