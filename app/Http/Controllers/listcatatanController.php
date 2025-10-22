<?php

namespace App\Http\Controllers;

use App\Models\catatan;
use Illuminate\Http\Request;

class listcatatanController extends Controller
{
     public function index()
    {
        $catatans = Catatan::orderBy('created_at', 'desc')->paginate(10);
        
        return view('wakasek.catatan.index', compact('catatans'));
    }

    /**
     * Update the specified catatan in storage.
     */
    public function update(Request $request, $id)
    {
        $catatan = catatan::findOrFail($id);
        
        $validated = $request->validate([
            'judul_catatan' => 'required|string|max:255',
            'isi_catatan' => 'required|string',
        ], [
            'judul_catatan.required' => 'Judul catatan harus diisi',
            'judul_catatan.max' => 'Judul catatan maksimal 255 karakter',
            'isi_catatan.required' => 'Isi catatan harus diisi',
        ]);

        $catatan->update($validated);

        return redirect()
            ->route('catatan.index')
            ->with('success', 'Catatan berhasil diperbarui!');
    }
}
