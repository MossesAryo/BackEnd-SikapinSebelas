<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Profil pengguna.
 * Tampilkan dan perbarui data profil akun.
 */
class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('wakasek.profile.profilewakasek', compact('user'));
    }

   
}
