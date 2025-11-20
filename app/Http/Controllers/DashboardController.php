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
use App\Models\walikelas;

use App\Models\GuruBkKelas;
use App\Models\guru_bk;
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

    // ====== 1. Tentukan FILTER berdasarkan ROLE ======
    $kelasFilter = [];      // untuk Guru BK atau Walikelas
    $jurusanFilter = null;  // untuk Kaprog

    // === Role 3: Ketua Program → filter berdasarkan JURUSAN ===
    if ($role == 3) {
        $ketua = ketua_program::where('username', $user->username)->first();
        if (!$ketua) abort(403, "Data Ketua Program tidak ditemukan.");
        $jurusanFilter = $ketua->jurusan;
    }

    // === Role 2: Guru BK → filter berdasarkan kelas yg diampu ===
    if ($role == 2) {
        $guruBK = guru_bk::where('username', $user->username)->first();
        if (!$guruBK) abort(403, "Data Guru BK tidak ditemukan.");

        // ambil kelas dari tabel guru_bk_kelas
        $kelasFilter = $guruBK->kelas->pluck('id_kelas')->toArray();
        if (empty($kelasFilter)) $kelasFilter = ['-null-']; // supaya kosong aman
    }

    // === Role 4: Walikelas → filter berdasarkan 1 kelas ===
    if ($role == 4) {
        $wali = walikelas::where('username', $user->username)->first();
        if (!$wali) abort(403, "Data Wali Kelas tidak ditemukan.");
        $kelasFilter = [$wali->id_kelas];
    }


    // ====== 2. Query SISWA ======
    $siswaQuery = siswa::query();

    // filter Kaprog (jurusan)
    if ($jurusanFilter) {
        $siswaQuery->whereHas('kelas', function ($q) use ($jurusanFilter) {
            $q->where('jurusan', $jurusanFilter);
        });
    }

    // filter Guru BK / Walikelas (kelas)
    if (!empty($kelasFilter)) {
        $siswaQuery->whereIn('id_kelas', $kelasFilter);
    }

    $nisList = $siswaQuery->pluck('nis');


    // ====== 3. Hitung data DASHBOARD ======
    $totalSiswa     = $siswaQuery->count();
    $rataSkor       = $siswaQuery->avg('poin_total');

    $totalApresiasi = siswa_penghargaan::whereIn('nis', $nisList)
        ->distinct('nis')->count('nis');

    $totalPelanggaran = siswa_sp::whereIn('nis', $nisList)
        ->distinct('nis')->count('nis');


    // ===== 4. Activity Log sesuai FILTER =====
    $recentActivities = ActivityLog::with(['user', 'siswa.kelas'])
        ->when($jurusanFilter, function ($q) use ($jurusanFilter) {
            $q->whereHas('siswa.kelas', function ($sub) use ($jurusanFilter) {
                $sub->where('jurusan', $jurusanFilter);
            });
        })
        ->when(!empty($kelasFilter), function ($q) use ($kelasFilter) {
            $q->whereHas('siswa', function ($sub) use ($kelasFilter) {
                $sub->whereIn('id_kelas', $kelasFilter);
            });
        })
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();


    // ====== 5. Data Chart (per jurusan) ======
    $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
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


    // ====== 6. Return VIEW sesuai role ======
    $data = [
        'totalSiswa' => $totalSiswa,
        'totalApresiasi' => $totalApresiasi,
        'totalPelanggaran' => $totalPelanggaran,
        'rataSkor' => $rataSkor,
        'jurusanList' => $jurusanList,
        'apresiasiData' => $apresiasiData,
        'pelanggaranData' => $pelanggaranData,
        'recentActivities' => $recentActivities,
    ];

    if ($role == 1) return view('wakasek.dashboard', $data);
    if ($role == 2) return view('gurubk.dashboard', $data);
    if ($role == 3) return view('ketua_program.dashboard', $data);
    if ($role == 4) return view('walikelas.dashboard', $data);

    abort(403, 'Role tidak dikenali.');
}

}