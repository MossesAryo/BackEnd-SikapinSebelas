<?php

namespace App\Http\Controllers;

use App\Models\aspek_penilaian;
use App\Models\penilaian;
use App\Models\siswa;
use Illuminate\Http\Request;

class Skoring_PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.skoring.pelanggaran.index', [
            "penilaian" => penilaian::whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', 'Pelanggaran');
            })->get(),
            "siswa" => siswa::all(),
            "aspekPel" => aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required|unique:penilaian,id_penilaian',
            'nis' => 'required',
            'id_aspekpenilaian' => 'required',
            'skor' => 'required|numeric',
        ]);

        Penilaian::create([
            'id_penilaian' => $request->id_penilaian,
            'nis' => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'nip_wakasek' => null,
            'nip_walikelas' => null,
            'nip_bk' =>  null,
            'created_at' => now(),
        ]);

        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_pelanggaran += $request->skor;
            $siswa->poin_total -= $request->skor;
            $siswa->save();
        }

        return redirect()->route('skoring_pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
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
    public function edit(string $id) {}

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
        $skoring = penilaian::findOrFail($id);
        $siswa = $skoring->siswa;



        
    $skor = $skoring->aspek_penilaian->indikator_poin ?? 0;  

    if ($siswa) {
        $siswa->poin_pelanggaran -= $skor;
        $siswa->poin_total += $skor;
        $siswa->save();
    }
        $skoring->delete();

        return redirect()->back()->with('success', 'Skoring berhasil dihapus!');
    }
}
