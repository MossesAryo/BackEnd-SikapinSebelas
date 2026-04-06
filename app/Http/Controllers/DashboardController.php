<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\siswa_sp;
use App\Models\ActivityLog;
use App\Models\siswa_penghargaan;
use App\Models\User;
use App\Models\walikelas;
use App\Models\guru_bk;
use App\Models\ketua_program;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        $kelasFilter = [];
        $jurusanFilter = null;

      
        if ($role == 4) {
            $ketua = ketua_program::where('username', $user->username)->first();
            if (!$ketua) abort(403, "Data Ketua Program tidak ditemukan.");

            $jurusanFilter = $ketua->id_jurusan;
        }

        
        if ($role == 2) {
            $guruBK = guru_bk::where('username', $user->username)->first();
            if (!$guruBK) abort(403, "Data Guru BK tidak ditemukan.");

            $kelasFilter = $guruBK->kelas->pluck('id_kelas')->toArray();
        }

        if ($role == 3) {
            $wali = walikelas::where('username', $user->username)->first();
            if (!$wali) abort(403, "Data Wali Kelas tidak ditemukan.");

            $kelasFilter = [$wali->id_kelas];
        }

        // Query siswa
        $siswaQuery = siswa::query();

        // Filter jurusan (langsung ke siswa)
        if ($jurusanFilter) {
            $siswaQuery->where('id_jurusan', $jurusanFilter);
        }

        // Filter kelas
        if (!empty($kelasFilter)) {
            $siswaQuery->whereIn('id_kelas', $kelasFilter);
        }

        $nisList = $siswaQuery->pluck('nis');

        // Statistik
        $totalSiswa = $siswaQuery->count();
        $rataSkor = $siswaQuery->avg('poin_total');

        $totalApresiasi = siswa_penghargaan::whereIn('nis', $nisList)
            ->distinct('nis')
            ->count('nis');

        $totalPelanggaran = siswa_sp::whereIn('nis', $nisList)
            ->distinct('nis')
            ->count('nis');

        // Activity log
        $recentActivities = ActivityLog::with(['user', 'siswa.kelas'])
            ->when($jurusanFilter, function ($q) use ($jurusanFilter) {
                $q->whereHas('siswa', function ($sub) use ($jurusanFilter) {
                    $sub->where('id_jurusan', $jurusanFilter);
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

        // Data ke view
        $data = [
            'totalSiswa' => $totalSiswa,
            'totalApresiasi' => $totalApresiasi,
            'totalPelanggaran' => $totalPelanggaran,
            'rataSkor' => $rataSkor,
            'recentActivities' => $recentActivities,
        ];

        return view('wakasek.dashboard', $data);
    }
}