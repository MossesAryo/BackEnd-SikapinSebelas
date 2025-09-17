<?php

namespace App\Http\Controllers\AuthAPI;

use App\Models\User;
use App\Models\walikelas;
use App\Models\ketua_program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthAPIcontroller extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        // Cek Kaprog
        $kaprog = ketua_program::where('nip_kaprog', $request->nip)->first();
        if ($kaprog) {
            $user = User::where('username', $kaprog->username)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('api_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'role' => 4,
                    'user' => $user,
                    'detail' => $kaprog,
                    'token' => $token
                ]);
            }
        }

        // Cek Wali Kelas
        $waliKelas = walikelas::where('nip_walikelas', $request->nip)->first();
        if ($waliKelas) {
            $user = User::where('username', $waliKelas->username)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('api_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'role' => 3,
                    'user' => $user,
                    'detail' => $waliKelas,
                    'token' => $token
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'NIP atau password salah'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
