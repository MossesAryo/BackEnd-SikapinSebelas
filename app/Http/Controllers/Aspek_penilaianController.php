<?php

namespace App\Http\Controllers;

use App\Models\aspek_penilaian;
use Illuminate\Http\Request;

class Aspek_penilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.aspek_penilaian.aspek_penilaian', [
            'aspek_penilaian' => aspek_penilaian::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'indikator_poin' => 'required',
            'uraian' => 'required',
        ]);

        aspek_penilaian::create($request->all());
        return redirect()->route('aspekpenilaian')->with('success', 'Aspek Penilaian berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'indikator_poin' => 'required',
            'uraian' => 'required',
        ]);

        aspek_penilaian::find($id)->update($data);
        return redirect()->route('aspekpenilaian')->with('success', 'Aspek Penilaian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = aspek_penilaian::find($id)->delete();

        return redirect()->route('aspekpenilaian')->with('success', 'Aspek Penilaian berhasil dihapus');
    }
}
