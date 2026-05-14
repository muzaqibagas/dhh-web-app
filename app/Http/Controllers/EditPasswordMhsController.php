<?php

namespace App\Http\Controllers;

use App\Models\EditPasswordMhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditPasswordMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('editpassmhs.index');
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
    public function show(EditPasswordMhs $editPasswordMhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditPasswordMhs $editPasswordMhs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EditPasswordMhs $editPasswordMhs)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama cocok
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password lama.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EditPasswordMhs $editPasswordMhs)
    {
        //
    }
}
