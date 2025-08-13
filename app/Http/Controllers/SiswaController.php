<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.siswa.index', [
            'siswa' => siswa::all(),
            'kelas' => kelas::all()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'id_kelas' => 'required',
            'nama_siswa' => 'required|string',
            'poin_apresiasi' => 'nullable|integer',
            'poin_pelanggaran' => 'nullable|integer',
        ]);


        $poin_apresiasi = $request->input('poin_apresiasi', 0);
        $poin_pelanggaran = $request->input('poin_pelanggaran', 0);


        $poin_total = $poin_apresiasi - $poin_pelanggaran;

        siswa::create([
            'nis' => $request->nis,
            'id_kelas' => $request->id_kelas,
            'nama_siswa' => $request->nama_siswa,
            'poin_apresiasi' => $poin_apresiasi,
            'poin_pelanggaran' => $poin_pelanggaran,
            'poin_total' => $poin_total,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = siswa::where('nis', $id)->first();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        }

        return view('wakasek.siswa.show', [
            'siswa' => $siswa,
            'kelas' => kelas::all()
        ]);
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
         $request->validate([
            'nis' => 'required|string',
            'id_kelas' => 'required',
            'nama_siswa' => 'required|string',
        ]);


        $sw = siswa::where('nis', $id)->first();


       
        $sw->update([
            'nis' => $request->nis,
            'id_kelas' => $request->id_kelas,
            'nama_siswa' => $request->nama_siswa,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
