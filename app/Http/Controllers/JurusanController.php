<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.jurusan.jurusan', [
            'jurusan' => jurusan::get(),
        ]);
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
            'id_jurusan' => 'required',
            'nama_jurusan' => 'required',
        ]);

        jurusan::create($request->all());
        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil ditambahkan');
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
    public function update(Request $request, string $id_jurusan)
    {
        $data = $request->validate([
            'id_jurusan' => 'required',
            'nama_jurusan' => 'required',
        ]);

        jurusan::where('id_jurusan', $id_jurusan)->update($data);
        return redirect()->route('jurusan')->with('success', 'jurusan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jurusan)
    {
        $data= jurusan::where('id_jurusan', $id_jurusan)->delete();

        return redirect()->route('jurusan')->with('success', 'jurusan berhasil dihapus');
    }
}
