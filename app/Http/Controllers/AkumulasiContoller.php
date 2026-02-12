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
        [$jurusanKetua, $kelasWalikelas] = $this->resolveRoleScope(Auth::user());

        // Jurusan list (dibatasi jika Kaprog)
        $jurusanList = $jurusanKetua
            ? collect([$jurusanKetua])
            : kelas::select('jurusan')->distinct()->pluck('jurusan');

        // Kelas list (dibatasi jika Kaprog atau Walikelas)
        $kelasList = kelas::query()
            ->when($jurusanKetua, fn($q) => $q->where('jurusan', $jurusanKetua))
            ->when($kelasWalikelas, fn($q) => $q->where('id_kelas', $kelasWalikelas))
            ->get();

        // Query siswa dengan filter role + request
        $query = $this->buildSiswaQuery($request, $jurusanKetua, $kelasWalikelas);

        $siswa = $query->paginate(10)->appends($request->all());

        return view('wakasek.akumulasi.index', [
            'siswa'          => $siswa,
            'jurusanList'    => $jurusanList,
            'kelasList'      => $kelasList,
            'jurusanKetua'   => $jurusanKetua,
            'kelasWalikelas' => $kelasWalikelas,
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

        if ($user->role == 3) {
            $ketua = ketua_program::where('username', $user->username)->first();
            if ($ketua && $ketua->jurusan) {
                $jurusanKetua = $ketua->jurusan;
            }
        }

        if ($user->role == 4) {
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