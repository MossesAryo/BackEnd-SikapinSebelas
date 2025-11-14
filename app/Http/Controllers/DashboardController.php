<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\siswa_sp;
use App\Models\penilaian;
use App\Models\ActivityLog;
use App\Models\penghargaan;
use Illuminate\Http\Request;
use App\Models\aspek_penilaian;
use App\Models\siswa_penghargaan;
use App\Models\User;
use App\Models\ketua_program;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $user = Auth::user();
    $role = $user->role;

    // === Jika Role 3 (Ketua Program), tentukan jurusan yang dipegang ===
    $jurusanFilter = null;

    if ($role == 3) {
        $ketua = ketua_program::where('username', $user->username)->first();

        if (!$ketua) {
            abort(403, "Data Ketua Program tidak ditemukan.");
        }

        $jurusanFilter = $ketua->jurusan; 
    }

    // === Query Siswa Berdasarkan Role ===
    $siswaQuery = siswa::query();

    if ($jurusanFilter) {
        $siswaQuery->whereHas('kelas', function ($q) use ($jurusanFilter) {
            $q->where('jurusan', $jurusanFilter);
        });
    }

    $nisList = $siswaQuery->pluck('nis');

    // === Hitungan Dashboard ===
    $totalSiswa = $siswaQuery->count();
    $rataRata = $siswaQuery->avg('poin_total');

    $totalApresiasi = siswa_penghargaan::whereIn('nis', $nisList)
        ->distinct('nis')
        ->count('nis');

    $totalPelanggaran = siswa_sp::whereIn('nis', $nisList)
        ->distinct('nis')
        ->count('nis');

    // === Aktivitas terbaru hanya untuk siswa jurusan tersebut ===
    $recentActivities = ActivityLog::with(['user', 'siswa.kelas'])
        ->when($jurusanFilter, function ($q) use ($jurusanFilter) {
            $q->whereHas('siswa.kelas', function ($sub) use ($jurusanFilter) {
                $sub->where('jurusan', $jurusanFilter);
            });
        })
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    // === Data Chart Berdasarkan Jurusan ===
    $jurusanList = $jurusanFilter 
        ? collect([$jurusanFilter])
        : kelas::select('jurusan')->distinct()->pluck('jurusan');

    $apresiasiData = [];
    $pelanggaranData = [];

    foreach ($jurusanList as $jurusan) {
        $nisJurusan = siswa::whereHas('kelas', function ($q) use ($jurusan) {
            $q->where('jurusan', $jurusan);
        })->pluck('nis');

        $apresiasiData[] = siswa_penghargaan::whereIn('nis', $nisJurusan)
            ->distinct('nis')
            ->count('nis');

        $pelanggaranData[] = siswa_sp::whereIn('nis', $nisJurusan)
            ->distinct('nis')
            ->count('nis');
    }

    // === data untuk view ===
    $data = [
        'totalSiswa' => $totalSiswa,
        'totalApresiasi' => $totalApresiasi,
        'totalPelanggaran' => $totalPelanggaran,
        'rataSkor' => $rataRata,
        'jurusanList' => $jurusanList,
        'apresiasiData' => $apresiasiData,
        'pelanggaranData' => $pelanggaranData,
        'recentActivities' => $recentActivities,
    ];

    // === Tentukan view ===
    if ($role == 1) return view('wakasek.dashboard', $data);
    if ($role == 2) return view('gurubk.dashboard', $data);
    if ($role == 3) return view('ketua_program.dashboard', $data);

    abort(403, 'Role tidak dikenali.');
}



}