<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginDosenController extends Controller
{
    public function index()
    {
        return view('auth.logindosen');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('staff')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            return redirect()->route('dashboarddosen');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logindosen');
    }
}