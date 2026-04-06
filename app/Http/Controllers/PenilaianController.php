<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Penilaian siswa.
 * Simpan dan ambil hasil penilaian lintas peran.
 */
class PenilaianController extends Controller
{
    public function index()
    {

        return view('wakasek.penilaian');
    }
}
