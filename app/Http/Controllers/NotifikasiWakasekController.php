<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;

class NotifikasiWakasekController extends Controller
{
    public function index()
    {
        $notifikasi = Intervensi::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Notifikasi',
            'data'    => $notifikasi
        ]);
    }
}
