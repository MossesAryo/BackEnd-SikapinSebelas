<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;


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

        // Kirim data walikelas dan kelas ke view
        return view('gurubk.intervensi.index', compact('intervensi', 'kelas', 'siswa'));
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
