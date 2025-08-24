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


    public function siswaGuruBk()
    {
        return view('gurubk.siswa', [
            'siswa' => Siswa::all(),
            'kelas' => Kelas::all()
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
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required',
        
        ]);


        // $poin_apresiasi = $request->input('poin_apresiasi', 0);
        // $poin_pelanggaran = $request->input('poin_pelanggaran', 0);
        // $poin_total = $poin_apresiasi - $poin_pelanggaran;

        siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
          
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
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
    public function update(Request $request, $nis)
{
 
    $request->validate([
        'nis' => 'required|integer',
        'nama_siswa' => 'required|string',
        'id_kelas' => 'required|string',
    ]);
  

    $siswa = Siswa::where('nis', $nis)->firstOrFail();

    $siswa->update([
        'nis' => $request->nis,
        'nama_siswa' => $request->nama_siswa,
        'id_kelas' => $request->id_kelas,
        
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
