<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\walikelas;
use App\Models\ketua_program;
use App\Models\guru_bk;
use App\Models\jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Controller API akumulasi poin siswa.
 * Menyajikan rekap pelanggaran/apresiasi serta ekspor laporan.
 */
class AkumulasiContoller extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $jurusanList = jurusan::all();
        $kelasList   = Kelas::with('jurusan')->get();

        $query = Siswa::with(['kelas.jurusan']);

        // === Guru BK (role 2): hanya kelas yang diajar ===
        if ($user->role == 2) {
            $guruBk = guru_bk::where('username', $user->username)->first();

            if ($guruBk) {
                $kelasIds = $guruBk->kelas()->pluck('kelas.id_kelas')->toArray();

                if (!empty($kelasIds)) {
                    $query->whereIn('id_kelas', $kelasIds);
                } else {
                    // Guru BK tidak punya kelas, return kosong
                    $siswa = Siswa::paginate(10);
                    return view('wakasek.akumulasi.index', compact('siswa', 'jurusanList', 'kelasList'));
                }
            }
        }

        // === Walikelas (role 3): hanya kelas yang dipegang ===
        elseif ($user->role == 3) {
            $walikelas = walikelas::where('username', $user->username)->first();

            if (!$walikelas) {
                abort(403, "Data Walikelas tidak ditemukan.");
            }

            $query->where('id_kelas', $walikelas->id_kelas);

            // Persempit dropdown kelas hanya miliknya
            $kelasList = Kelas::where('id_kelas', $walikelas->id_kelas)->get();
        }

        // === Ketua Program (role 4): hanya jurusan yang dipegang ===
        elseif ($user->role == 4) {
            $ketua = ketua_program::where('username', $user->username)->first();

            if (!$ketua) {
                abort(403, "Data Ketua Program tidak ditemukan.");
            }

            $query->whereHas('kelas.jurusan', function ($q) use ($ketua) {
                $q->where('id_jurusan', $ketua->id_jurusan);
            });

            // Persempit dropdown kelas sesuai jurusannya
            $kelasList = Kelas::whereHas('jurusan', function ($q) use ($ketua) {
                $q->where('id_jurusan', $ketua->id_jurusan);
            })->get();
        }

        // Tambahkan filter dari request (tidak menimpa filter role)
        $query = $this->applyRequestFilters($request, $query, $user);

        $siswa = $query->orderBy('nama_siswa')->paginate(10)->appends($request->all());

        return view('wakasek.akumulasi.index', compact('siswa', 'jurusanList', 'kelasList'));
    }

    public function export_pdf(Request $request)
    {
        try {
        ini_set('memory_limit', '512M');

        $user  = Auth::user();
        $query = Siswa::with(['kelas.jurusan']);
        $query = $this->applyRoleScope($query, $user);
        $query = $this->applyRequestFilters($request, $query, $user);

        $akumulasi = $query->limit(200)->get();

        $pdf = Pdf::loadView('Export.akumulasi.pdf', compact('akumulasi'));
        return $pdf->download('akumulasi.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function export_Excel(Request $request)
    {
        try {
        $user  = Auth::user();
        $query = Siswa::with(['kelas.jurusan']);
        $query = $this->applyRoleScope($query, $user);
        $query = $this->applyRequestFilters($request, $query, $user);

        $akumulasi = $query->get();

        return Excel::download(new \App\Exports\Akumulasi_ExportExcel($akumulasi), 'akumulasi.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function fetchAPI(Request $request)
    {
        try {
        $jurusanList = jurusan::all();
        $kelasList   = Kelas::with('jurusan')->get();

        $query = Siswa::with(['kelas.jurusan']);

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas.jurusan', fn($q) => $q->where('id_jurusan', $request->jurusan));
        }

        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }

        $siswa = $query->paginate(10)->withQueryString();

        return response()->json([
            'success'      => true,
            'message'      => 'Data siswa berhasil diambil',
            'jurusan_list' => $jurusanList,
            'kelas_list'   => $kelasList,
            'data'         => $siswa,
        ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    public function indexBK(Request $request)
    {
        $user   = Auth::user();
        $guruBk = guru_bk::where('username', $user->username)->first();

        $query = Siswa::with(['kelas.jurusan']);

        if ($guruBk) {
            $kelasIds = $guruBk->kelas()->pluck('kelas.id_kelas')->toArray();
            if (!empty($kelasIds)) {
                $query->whereIn('id_kelas', $kelasIds);
            }
        }

        $query = $this->applyRequestFilters($request, $query, $user);

        $jurusanList = jurusan::all();
        $kelasList   = Kelas::with('jurusan')->get();
        $siswa       = $query->get();

        return view('gurubk.akumulasi.index', compact('siswa', 'jurusanList', 'kelasList'));
    }

    /* ======================= Helpers ======================= */

    /**
     * Terapkan scope berdasarkan role (tanpa filter request).
     * Dipakai di export agar konsisten dengan index().
     */
    private function applyRoleScope($query, $user)
    {
        if ($user->role == 2) {
            $guruBk = guru_bk::where('username', $user->username)->first();
            if ($guruBk) {
                $kelasIds = $guruBk->kelas()->pluck('kelas.id_kelas')->toArray();
                if (!empty($kelasIds)) {
                    $query->whereIn('id_kelas', $kelasIds);
                }
            }
        } elseif ($user->role == 3) {
            $walikelas = walikelas::where('username', $user->username)->first();
            if ($walikelas) {
                $query->where('id_kelas', $walikelas->id_kelas);
            }
        } elseif ($user->role == 4) {
            $ketua = ketua_program::where('username', $user->username)->first();
            if ($ketua) {
                $query->whereHas('kelas.jurusan', fn($q) => $q->where('id_jurusan', $ketua->id_jurusan));
            }
        }

        return $query;
    }

    /**
     * Terapkan filter dari request (jurusan, kelas, search).
     * Filter jurusan/kelas diabaikan jika role sudah membatasi scope tersebut.
     */
    private function applyRequestFilters(Request $request, $query, $user)
    {
        // Filter jurusan hanya untuk role yang belum terikat jurusan (bukan role 4)
        if ($request->filled('jurusan') && $user->role != 4) {
            $query->whereHas('kelas.jurusan', fn($q) => $q->where('id_jurusan', $request->jurusan));
        }

        // Filter kelas hanya untuk role yang belum terikat kelas spesifik (bukan role 3)
        if ($request->filled('kelas') && $user->role != 3) {
            $query->where('id_kelas', $request->kelas);
        }

        // Search NIS / nama_siswa (berlaku semua role)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'like', '%' . $search . '%')
                  ->orWhere('nama_siswa', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }
}
