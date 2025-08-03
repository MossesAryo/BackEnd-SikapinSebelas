<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa; // Pastikan model siswa sudah diimport

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data siswa dari database
        $siswa = siswa::all(); // Atau gunakan paginate() jika ingin paginasi
        // Kirim data siswa ke view
        return view('wakasek.siswa.dashboard', compact('siswa'));

      
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wakasek.siswa.create', [
            'siswa' => siswa::get(),
          
        ]);
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
