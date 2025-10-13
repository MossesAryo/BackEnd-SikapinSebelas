<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;

class StatusIntervensiController extends Controller
{
    public function index()
    {
        $intervensi = intervensi::get();
        return view('wakasek.statusIntervensi.index',compact('intervensi'));
    }
    public function show($id)
    {
        $intervensi = intervensi::where('id_intervensi', $id)->first();
        return view('wakasek.statusIntervensi.show',compact('intervensi'));
    }
}
