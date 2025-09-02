<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\siswa;

use App\Exports\Akumulasi_ExportExcel;
use App\Imports\Akumulasi_Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class AkumulasiContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('wakasek.akumulasi.index', compact('siswa', 'jurusanList', 'kelasList'));
    }

    public function indexBK()
    {
        return view('gurubk.akumulasi.index', [
            'siswa' => siswa::all(),

        ]);
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
