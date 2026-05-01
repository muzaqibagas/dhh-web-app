<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loginmhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // ========================
        // CEK USER (ADMIN / MAHASISWA)
        // ========================
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);

            return redirect()->intended(
                $user->role === 'Admin'
                    ? route('dashboardadm.index')
                    : route('dashboardmhs.index')
            );
        }

        // ========================
        // CEK STAFF / DOSEN
        // ========================
        $staff = \App\Models\StaffDept::where('username', $request->username)->first();

        if ($staff && Hash::check($request->password, $staff->password)) {
            Auth::guard('staff')->login($staff);

            return redirect()->route('dashboarddosen.index');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ]);
    }


    public function verifyEmail(EmailVerificationRequest $request)
    {        
        if (!$request->user()->hasVerifiedEmail()) {
            $request->fulfill();
        }

        return redirect()->intended(
            auth()->user()->role === 'Admin'
                ? route('admprofile.index')
                : route('profilemhs.edit')
        );
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


}
