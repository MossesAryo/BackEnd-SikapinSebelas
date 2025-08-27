<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\guru_bk;
use App\Models\User;
use App\Models\Wakasek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        $role = null;
        $user = null;

        $wakasek = Wakasek::where('nip_wakasek', $request->nip)->first();
        if ($wakasek) {
            $user = User::where('username', $wakasek->username)->first();
            $role = 'wakasek';
        }

        if (!$user) {
            $guru_bk = guru_bk::where('nip_bk', $request->nip)->first();
            if ($guru_bk) {
                $user = User::where('username', $guru_bk->username)->first();
                $role = 'guru_bk';
            }
        }

        if (!$user) {
            return back()->withErrors(['nip' => 'NIP tidak ditemukan']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        Auth::login($user);

        if ($role === 'wakasek') {
            return redirect()->route('wakasek.dashboard')->with('success', 'Berhasil login');
        } elseif ($role === 'guru_bk') {
            return redirect()->route('bk.dashboard')->with('success', 'Berhasil login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
