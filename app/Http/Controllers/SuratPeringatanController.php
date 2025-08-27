<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\surat_peringatan;

class SuratPeringatanController extends Controller
{
    public function index()
    {
        $peringatan = surat_peringatan::all();
        return view('wakasek.peringatan.index', compact('peringatan'));
    }

    public function fetchApi()
    {
        $peringatan = surat_peringatan::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Penghargaan berhasil diambil',
            'data'    => $peringatan
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sp' => 'required',
            'tanggal_sp' => 'required|date',
            'level_sp' => 'required|in:SP1,SP2,SP3',
            'alasan' => 'required|string|max:255',
        ]);

        surat_peringatan::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id_sp)
    {
        $request->validate([
            'id_sp' => 'required',
            'tanggal_sp' => 'required|date',
            'level_sp' => 'required|in:SP1,SP2,SP3',
            'alasan' => 'required|string|max:255',
        ]);

        $data = [
            'id_sp' => $request->id_sp,
            'tanggal_sp' => $request->tanggal_sp,
            'level_sp' => $request->level_sp,
            'alasan' => $request->alasan,
        ];

        $updated = surat_peringatan::where('id_sp', $id_sp)->update($data);
        return redirect()->route('peringatan.index')->with('success', 'Peringatan berhasil diedit.');
    }


    public function destroy($id)
    {
        $peringatan = surat_peringatan::findOrFail($id);
        $peringatan->delete();

        return redirect()->route('peringatan.index')->with('success', 'Data surat peringatan berhasil dihapus.');
    }
}
