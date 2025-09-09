<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use Illuminate\Http\Request;

class catatanController extends Controller
{
    public function AddCatatan(Request $request, $nis)
    {
         $request->validate([
            'judul_catatan' => 'required|string',
            'isi_catatan'   => 'required|string',
        ]);

        catatan::create([
            'nis' => $nis,
            'judul_catatan' => $request->judul_catatan,
            'isi_catatan'   => $request->isi_catatan,
            // 'nip_wakasek'   => auth()->user()->nip_wakasek ?? null,
            // 'nip_walikelas' => auth()->user()->nip_walikelas ?? null,
        ]);

       return redirect()->back()->with('success', 'Penghargaan berhasil ditambahkan');
    }
}
