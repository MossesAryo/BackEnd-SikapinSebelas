<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;

class NotifikasiWakasekController extends Controller
{
    public function index()
    {
        $notifikasi = intervensi::all();
        return view('wakasek.notifikasi.notifikasi',compact('notifikasi'));
    }
}
