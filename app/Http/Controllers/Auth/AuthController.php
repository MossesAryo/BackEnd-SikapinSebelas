<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\guru_bk;
use App\Models\User;
use App\Models\wakasek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip_wakasek' => 'required',
            'password' => 'required',
        ]);

        $wakasek = Wakasek::where('nip_wakasek', $request->nip_wakasek)->first();

        if (!$wakasek) {
            return back()->withErrors(['nip_wakasek' => 'NIP tidak ditemukan']);
        }

        $user = User::where('username', $wakasek->username)->first();

        // Tanpa hash
        if (!$user || $request->password !== $user->password) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        Auth::login($user);

        return redirect()->route('wakasek.dashboard')->with('success', 'Berhasil login');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
