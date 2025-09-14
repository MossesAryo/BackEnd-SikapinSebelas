<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\catatan;


class IntervensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $intervensi = intervensi::all();
        $kelas = kelas::all();
        $siswa = siswa::all();
        $catatan = catatan::all();

        // Kirim data walikelas dan kelas ke view
        return view('gurubk.intervensi.index', compact('intervensi', 'kelas', 'siswa', 'catatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama_intervensi' => 'required|string|max:255',
            'tanggal_Mulai_Perbaikan' => 'required|date',
            'tanggal_Selesai_Perbaikan' => 'required|date|after_or_equal:tanggal_Mulai_Perbaikan',
            'status' => 'required|string|max:50',

        ]);

        intervensi::create([
            'nis' => $request->nis,
            'nama_intervensi' => $request->nama_intervensi,
            'tanggal_Mulai_Perbaikan' => $request->tanggal_Mulai_Perbaikan,
            'tanggal_Selesai_Perbaikan' => $request->tanggal_Selesai_Perbaikan,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        return redirect()->route('intervensi.index')->with('success', 'Data intervensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_intervensi)
    {
        $intervensi = Intervensi::where(['siswa.kelas'])->findOrFail($id_intervensi);

        return view('gurubk.intervensi.show', compact('intervensi'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_intervensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
