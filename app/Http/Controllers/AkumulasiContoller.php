<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\walikelas;
use App\Models\ketua_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Akumulasi_ExportExcel;

class AkumulasiContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $user = Auth::user();

    // Ambil daftar jurusan & kelas untuk dropdown
    $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');
    $kelasList   = Kelas::select('id_kelas', 'nama_kelas', 'jurusan')->get();

    // Mulai query siswa
    $query = Siswa::with('kelas');

    // Filter berdasarkan role
    if ($user->role == 2) {
        // Guru BK -> filter kelas sesuai guru
        $guruBk = guru_bk::where('username', $user->username)->first();

        if ($guruBk) {
            $kelasByGuru = [
                'Dra. Wening Wigati, S.E, M.Si' => ['X AK 1','X AK 2','X AK 3','X DKV 1','X DKV 2','X TKJ 1','XII MP 1','XII MP 2','XII MP 3'],
                'Ratih Pratiwi, S.Pd' => ['X PM 1','X PM 2','X PM 3','X PPLG 1','X PPLG 2','XI BR 1','XI BR 2','XI TKJ 1','XII TKJ 1'],
                'Suci' => ['XI MP 1','XI MP 2','XI MP 3','XI MLOG 1','XI DKV 1','XI DKV 2','XII BR 1','XII BR 2','XII BR 3'],
                'Evi Febry Damayanti, S.Pd' => ['X MPLB 1','X MPLB 2','X MPLB 3','X MPLB 4','XI RPL 1','XI RPL 2','XII RPL 1','XII RPL 2'],
                'Raden Roro Siti Ameliya Purnama Putri, S.Pd' => ['XI AK 1','XI AK 2','XI AK 3','XI AK 4','XII AK 1','XII AK 2','XII AK 3','XII DKV 1','XII DKV 2'],
            ];

            $kelasGuru = $kelasByGuru[$guruBk->nama] ?? [];
            
            // Filter siswa hanya di kelas yang dia pegang
            $query->whereIn('id_kelas', function($q) use ($kelasGuru) {
                $q->select('id_kelas')->from('kelas')->whereIn('nama_kelas', $kelasGuru);
            });
        }

    } elseif ($user->role == 4) {
        // Kaprog -> filter berdasarkan jurusan
        [$jurusanKetua, $kelasWalikelas] = $this->resolveRoleScope($user);
        $query->whereHas('kelas', fn($q) => $q->where('jurusan', $jurusanKetua));
    }

    // Tambahkan filter tambahan dari request jika ada
    $query = $this->buildSiswaQuery($request, $user->role == 4 ? $jurusanKetua : null, null, $query);

    // Paginate hasil
    $siswa = $query->paginate(10)->appends($request->all());

    return view('wakasek.akumulasi.index', [
        'siswa'       => $siswa,
        'jurusanList' => $jurusanList,
        'kelasList'   => $kelasList,
    ]);
}



    public function fetchAPI(Request $request)
    {
        // (dibiarkan seperti semula; bisa disesuaikan dengan helper jika mau)
        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = kelas::all();

        $query = siswa::query();

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }

        if ($request->filled('kelas')) {
            // gunakan id_kelas jika form mengirim id_kelas; sesuaikan jika mau pakai nama_kelas
            $query->whereHas('kelas', fn($q) => $q->where('id_kelas', $request->kelas));
        }

        $siswa = $query->paginate(10)->withQueryString();

        return response()->json([
            'success'      => true,
            'message'      => 'Data siswa berhasil diambil',
            'jurusan_list' => $jurusanList,
            'kelas_list'   => $kelasList,
            'data'         => $siswa
        ], 200);
    }

    public function indexBK(Request $request)
    {
        // (dibiarkan seperti semula; bisa disesuaikan dengan helper jika mau)
        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = kelas::all();

        $query = siswa::query();

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('id_kelas', $request->kelas));
        }

        $siswa = $query->get();

        return view('gurubk.akumulasi.index', compact('siswa', 'jurusanList', 'kelasList'));
    }

    public function export_pdf(Request $request)
    {
        ini_set('memory_limit','512M');

        [$jurusanKetua, $kelasWalikelas] = $this->resolveRoleScope(Auth::user());

        $akumulasi = $this->buildSiswaQuery($request, $jurusanKetua, $kelasWalikelas)->get();

        $pdf = PDF::loadView('Export.akumulasi.pdf', compact('akumulasi'));
        return $pdf->download('akumulasi.pdf');
    }

public function export_Excel(Request $request)
{
    [$jurusanKetua, $kelasWalikelas] = $this->resolveRoleScope(Auth::user());

    // Data sudah terfilter sesuai role + filter jurusan/kelas/search
    $akumulasi = $this->buildSiswaQuery($request, $jurusanKetua, $kelasWalikelas)->get();

    return Excel::download(new \App\Exports\Akumulasi_ExportExcel($akumulasi), 'akumulasi.xlsx');
}

    /* ======================= Helper ======================= */

    private function resolveRoleScope($user): array
    {
        $jurusanKetua   = null; // Kaprog (role 3)
        $kelasWalikelas = null; // Walikelas (role 4)

        if ($user->role == 4) {
            $ketua = ketua_program::where('username', $user->username)->first();
            if ($ketua && $ketua->jurusan) {
                $jurusanKetua = $ketua->jurusan;
            }
        }

        if ($user->role == 3) {
            $walikelas = walikelas::where('username', $user->username)->first();
            if ($walikelas && $walikelas->id_kelas) {
                $kelasWalikelas = $walikelas->id_kelas;
            }
        }

        return [$jurusanKetua, $kelasWalikelas];
    }

    private function buildSiswaQuery(Request $request, $jurusanKetua, $kelasWalikelas)
    {
        $query = siswa::with('kelas');

        // Filter otomatis berdasarkan role
        if ($jurusanKetua) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $jurusanKetua));
        }
        if ($kelasWalikelas) {
            $query->whereHas('kelas', fn($q) => $q->where('id_kelas', $kelasWalikelas));
        }

        // Filter request (tidak menimpa filter role)
        if ($request->filled('jurusan') && !$jurusanKetua) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }
        if ($request->filled('kelas') && !$kelasWalikelas) {
            $query->whereHas('kelas', fn($q) => $q->where('id_kelas', $request->kelas));
        }

        // Search NIS / nama_siswa
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