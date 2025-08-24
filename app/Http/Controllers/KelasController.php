<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\jurusan;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = kelas::all();

        return view('wakasek.kelas.kelas', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
        ]);

        kelas::create($request->all());

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_kelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
        ]);

        kelas::where('id_kelas', $id)->update($data);
        return redirect()->route('kelas')->with('success', 'kelas berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = kelas::where('id_kelas', $id)->delete();

        return redirect()->route('kelas')->with('success', 'kelas berhasil dihapus');
    }
}
