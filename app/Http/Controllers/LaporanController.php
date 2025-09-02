<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\siswa;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan jam malam untuk Wakasek.
     */
    public function index()
    {
        return view('wakasek.laporanjammalam');
    }

    public function view(Request $request)
    {
        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = Kelas::all();

        $query = Siswa::query();

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('nama_kelas', $request->kelas));
        }

        $siswa = $query->get();

        return view('wakasek.laporan.laporan', compact('siswa', 'jurusanList', 'kelasList'));
    }
}
