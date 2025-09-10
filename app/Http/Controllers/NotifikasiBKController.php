<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use Illuminate\Http\Request;

class NotifikasiBKController extends Controller
{
    public function index()
    {
        $notifikasi = catatan::all();
        return view('gurubk.notifikasi.notifikasi',compact('notifikasi'));
    }
}
