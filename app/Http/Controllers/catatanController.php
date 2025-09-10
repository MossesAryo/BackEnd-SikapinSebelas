<?php

namespace App\Http\Controllers;

use App\Models\catatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class catatanController extends Controller
{
    public function AddCatatan(Request $request, $nis)
    {
        $user = Auth::user();
         $request->validate([
            'judul_catatan' => 'required|string',
            'isi_catatan'   => 'required|string',
        ]);

        catatan::create([
            'nis' => $nis,
            'judul_catatan' => $request->judul_catatan,
            'isi_catatan'   => $request->isi_catatan,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
        ]);

       return redirect()->back()->with('success', 'Catatan   berhasil ditambahkan');
    }
}
