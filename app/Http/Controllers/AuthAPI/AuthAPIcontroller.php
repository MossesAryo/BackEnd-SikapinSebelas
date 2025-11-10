<?php

namespace App\Http\Controllers\AuthAPI;

use App\Models\User;
use App\Models\walikelas;
use App\Models\ketua_program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAPIcontroller extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        // ===== CEK KAPROG =====
        $kaprog = ketua_program::where('nip_kaprog', $request->nip)->first();
        if ($kaprog) {
            $user = User::where('username', $kaprog->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user); // ⬅️ Simpan user ke session

                return response()->json([
                    'status' => true,
                    'role' => 4,
                    'user' => $user,
                    'detail' => $kaprog,
                    'message' => 'Login berhasil (Kaprog)'
                ]);
            }
        }

        // ===== CEK WALI KELAS =====
        $waliKelas = walikelas::where('nip_walikelas', $request->nip)->first();
        if ($waliKelas) {
            $user = User::where('username', $waliKelas->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user); // ⬅️ Simpan user ke session

                return response()->json([
                    'status' => true,
                    'role' => 3,
                    'user' => $user,
                    'detail' => $waliKelas,
                    'message' => 'Login berhasil (Wali Kelas)'
                ]);
            }
        }

        // Jika gagal
        return response()->json([
            'status' => false,
            'message' => 'NIP atau password salah'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // ⬅️ Hapus session user

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
