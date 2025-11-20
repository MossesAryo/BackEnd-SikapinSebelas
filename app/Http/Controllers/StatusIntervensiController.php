<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;
use App\Models\ketua_program;
use App\Models\walikelas;
use Illuminate\Support\Facades\Auth;

class StatusIntervensiController extends Controller
{

public function index()
{
    $user = Auth::user();
    $query = intervensi::query();
    $jurusanKetua = null;
    $kelasWalikelas = null;

    // ==== Jika role 3 (ketua program) → hanya tampil jurusan sesuai ketua ====
    if ($user->role == 3) {

        $ketua = ketua_program::where('username', $user->username)->first();

        // Jika data ketua program ditemukan dan punya jurusan
        if ($ketua && $ketua->jurusan) {

            $jurusanKetua = $ketua->jurusan;

            // Filter intervensi berdasarkan jurusan siswa
            $query->whereHas('siswa.kelas', function ($q) use ($jurusanKetua) {
                $q->where('jurusan', $jurusanKetua);
            });
        }
    }
    if ($user->role == 4) {

        $walikelas = walikelas::where('username', $user->username)->first();

        // Jika data ketua program ditemukan dan punya jurusan
        if ($walikelas && $walikelas->id_kelas) {

            $kelasWalikelas = $walikelas->id_kelas;

            // Filter intervensi berdasarkan jurusan siswa
            $query->whereHas('siswa.kelas', function ($q) use ($kelasWalikelas) {
                $q->where('id_kelas', $kelasWalikelas);
            });
        }
    }

    // Jika bukan ketua → tampilkan semua
    $intervensi = $query->get();

    return view('wakasek.statusIntervensi.index', compact('intervensi', 'jurusanKetua', 'kelasWalikelas'));
}

    public function show($id)
    {
        $intervensi = intervensi::where('id_intervensi', $id)->first();
        return view('wakasek.statusIntervensi.show',compact('intervensi'));
    }
}
