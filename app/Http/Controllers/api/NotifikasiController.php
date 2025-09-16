<?php

namespace App\Http\Controllers\api;

use App\Models\intervensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = intervensi::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Notifikasi',
            'data'    => $notifikasi
        ]);
    }
}
