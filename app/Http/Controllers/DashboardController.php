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

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
   
    $totalSiswa = siswa::count();
    $rataRata = siswa::avg('poin_total');
    $totalApresiasi = siswa_penghargaan::distinct('nis')->count('nis');
    $totalPelanggaran = siswa_sp::distinct('nis')->count('nis');
    $recentActivities = ActivityLog::with(['user'])
    ->orderBy('created_at', 'desc')
    ->limit(5)
    ->get();

    // Ambil daftar jurusan dari tabel kelas
    $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');

    // Siapkan array untuk hasil per jurusan
    $apresiasiData = [];
    $pelanggaranData = [];

    foreach ($jurusanList as $jurusan) {
        // Ambil semua NIS siswa dari jurusan tersebut
        $nisList = siswa::whereHas('kelas', function ($q) use ($jurusan) {
            $q->where('jurusan', $jurusan);
        })->pluck('nis');

        // Hitung siswa unik yang mendapat apresiasi
        $jumlahApresiasi = siswa_penghargaan::whereIn('nis', $nisList)
            ->distinct('nis')
            ->count('nis');

        // Hitung siswa unik yang mendapat pelanggaran
        $jumlahPelanggaran = siswa_sp::whereIn('nis', $nisList)
            ->distinct('nis')
            ->count('nis');

        $apresiasiData[] = $jumlahApresiasi;
        $pelanggaranData[] = $jumlahPelanggaran;
    }

    return view('wakasek.dashboard', [
        'totalSiswa' => $totalSiswa,
        'totalApresiasi' => $totalApresiasi,
        'totalPelanggaran' => $totalPelanggaran,
        'rataSkor' => $rataRata,
        'jurusanList' => $jurusanList,
        'apresiasiData' => $apresiasiData,
        'pelanggaranData' => $pelanggaranData,
        'recentActivities' => $recentActivities,
    ]);


}

}
