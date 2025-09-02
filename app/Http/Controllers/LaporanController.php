<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('wakasek.laporanjammalam');
    }

    public function view(Request $request)
    {
        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = Kelas::all();

        $query = Siswa::query()->with('kelas');

        // Filter jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }

        // Filter kelas
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('nama_kelas', $request->kelas));
        }

        $siswa = $query->get();

        return view('wakasek.laporan.laporan', compact('siswa', 'jurusanList', 'kelasList'));
    }

    /**
     * Export data laporan ke PDF atau Excel dengan filter
     */
    public function export(Request $request)
    {
        $query = Siswa::query()->with('kelas');

        // Filter jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }

        // Filter kelas
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('nama_kelas', $request->kelas));
        }

        $akumulasi = $query->get();

        // Ekspor PDF
        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('export.laporan.pdf', compact('akumulasi'));
            return $pdf->download('laporan_akumulasi.pdf');
        }

        // Ekspor Excel
        if ($request->format === 'excel') {
            return Excel::download(new LaporanExport($akumulasi), 'laporan_akumulasi.xlsx');
        }

        return redirect()->back()->with('error', 'Format ekspor tidak valid');
    }
}
