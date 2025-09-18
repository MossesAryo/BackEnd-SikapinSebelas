<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use App\Models\intervensi;
use Illuminate\Http\Request;

class NotifikasiWakasekController extends Controller
{
    public function index()
    {
        $notifikasi = intervensi::all();
        $notifikasibk = catatan::all();
        return view('wakasek.notifikasi.notifikasi',compact('notifikasi', 'notifikasibk'));
    }
}
