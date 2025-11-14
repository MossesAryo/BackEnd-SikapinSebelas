<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\siswa;

use App\Exports\Akumulasi_ExportExcel;
use App\Imports\Akumulasi_Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\ketua_program;

class AkumulasiContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $user = Auth::user();
    $jurusanKetua = null;

    // ==== Cek role 3 (ketua program) ====
    if ($user->role == 3) {
        $ketua = ketua_program::where('username', $user->username)->first();

        if ($ketua && $ketua->jurusan) {
            $jurusanKetua = $ketua->jurusan;
        }
    }

    // ==== List Jurusan (kalau ketua → hanya satu) ====
    if ($jurusanKetua) {
        $jurusanList = collect([$jurusanKetua]); // hanya jurusan ketua
    } else {
        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
    }

    // ==== List Kelas (kalau ketua → kelas sesuai jurusan ketua) ====
    if ($jurusanKetua) {
        $kelasList = kelas::where('jurusan', $jurusanKetua)->get();
    } else {
        $kelasList = kelas::all();
    }

    // ==== Query siswa ====
    $query = siswa::query();

    // Filter otomatis oleh jurusan ketua program
    if ($jurusanKetua) {
        $query->whereHas('kelas', function ($q) use ($jurusanKetua) {
            $q->where('jurusan', $jurusanKetua);
        });
    }

    // ==== Filter request jurusan (jika user bukan ketua) ====
    if ($request->filled('jurusan') && !$jurusanKetua) {
        $query->whereHas('kelas', fn ($q) => $q->where('jurusan', $request->jurusan));
    }

    // ==== Filter kelas ====
    if ($request->filled('kelas')) {
        $query->whereHas('kelas', fn ($q) => $q->where('nama_kelas', $request->kelas));
    }

    $siswa = $query->paginate(10)->withQueryString();

    return view('wakasek.akumulasi.index', [
        "siswa"        => $siswa,
        "jurusanList"  => $jurusanList,
        "kelasList"    => $kelasList,
        "jurusanKetua" => $jurusanKetua, // untuk auto-select di blade
    ]);
}


    public function fetchAPI(Request $request)
    {
        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = kelas::all();

        $query = siswa::query();

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }

        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('nama_kelas', $request->kelas));
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

        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = Kelas::all();

        $query = siswa::query();

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('nama_kelas', $request->kelas));
        }

        $siswa = $query->get();

        return view('gurubk.akumulasi.index', compact('siswa', 'jurusanList', 'kelasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    public function export_pdf()
    {
        $akumulasi = Siswa::with('kelas')->get();

        $pdf = PDF::loadView('export.akumulasi.pdf', compact('akumulasi'));
        return $pdf->download('akumulasi.pdf');
    }

    public function export_Excel()
    {
        return Excel::download(new Akumulasi_ExportExcel, 'akumulasi.xlsx');
    }
}
