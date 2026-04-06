<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use App\Models\intervensi;
use Illuminate\Http\Request;

/**
 * Notifikasi untuk wakasek.
 * Ambil, tandai, dan tampilkan notifikasi disiplin.
 */
class NotifikasiWakasekController extends Controller
{
    public function index()
    {
        $notifikasi = intervensi::all();
        $notifikasibk = catatan::all();
        return view('wakasek.notifikasi.notifikasi',compact('notifikasi', 'notifikasibk'));
    }
}
