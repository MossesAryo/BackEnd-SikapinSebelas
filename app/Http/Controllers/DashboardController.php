<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\aspek_penilaian;
use App\Models\penilaian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSiswa = Siswa::count();

        $idApresiasi = Aspek_Penilaian::where('jenis_poin', 'apresiasi')->pluck('id_aspekpenilaian');

        $idPelanggaran = Aspek_Penilaian::where('jenis_poin', 'pelanggaran')->pluck('id_aspekpenilaian');

        $totalApresiasi = Penilaian::whereIn('id_aspekpenilaian', $idApresiasi)
            ->select('nis')
            ->distinct()
            ->count();

        $totalPelanggaran = Penilaian::whereIn('id_aspekpenilaian', $idPelanggaran)
            ->select('nis')
            ->distinct()
            ->count();

        return view('wakasek.dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalApresiasi' => $totalApresiasi,
            'totalPelanggaran' => $totalPelanggaran
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
