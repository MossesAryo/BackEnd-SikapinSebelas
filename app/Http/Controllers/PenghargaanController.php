<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghargaan;

class PenghargaanController extends Controller
{
    public function index()
    {
        $penghargaan = Penghargaan::all();
        return view('wakasek.penghargaan.index', compact('penghargaan'));
    }

  
public function store(Request $request)
{
     $request->validate([
            'id_penghargaan' => 'required',
            'tanggal_penghargaan' => 'required|date',
            'level_penghargaan' => 'required|in:PH1,PH2,PH3',
            'alasan' => 'required|string|max:255',
        ]);
    Penghargaan::create($request->all());
    return redirect()->back()->with('success', 'Data berhasil disimpan');
}
    public function update(Request $request, $id)
    {
        $request->validate([

            'id_penghargaan' => 'required',
            'tanggal_penghargaan' => 'required|date',
            'level_penghargaan' => 'required|in:PH1,PH2,PH3',
            'alasan' => 'required|string|max:255',
        ]);

        $penghargaan = Penghargaan::findOrFail($id);
        $penghargaan->update($request->all());

        return redirect()->route('penghargaan.index')->with('success', 'Data penghargaan berhasil diubah.');
    }

    public function destroy($id)
    {
        $penghargaan = Penghargaan::findOrFail($id);
        $penghargaan->delete();

        return redirect()->route('penghargaan.index')->with('success', 'Data penghargaan berhasil dihapus.');
    }
}
