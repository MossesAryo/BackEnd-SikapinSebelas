<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('Auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $role = Auth::user()->role;

        if ($role === 'wakasek') {
            return view('wakasek.dashboard');
        } elseif ($role === 'gurubk') {
            return view('gurubk.dashboard');
        } elseif ($role === 'ketua_program') {
            return view('ketua_program.dashboard');
        }
    }

    return back()->withErrors(['login' => 'Email atau password salah']);
}

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
