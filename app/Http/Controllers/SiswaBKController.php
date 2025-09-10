<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

use App\Exports\Siswa_ExportExcel;
use App\Imports\Siswa_Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SiswaBKController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function export_excel_siswaBK()
    {
        return Excel::download(new Siswa_ExportExcel, 'siswa.xlsx');
    }
    
      public function import_siswaBK(Request $request)
    {
        $siswa = siswa::all();

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Siswa_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Siswa berhasil diimport!');
    }
    


 public function siswaGuruBk(Request $request)
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

        $siswa = $query->paginate(2);

        return view('gurubk.siswa.siswa', compact('siswa', 'jurusanList', 'kelasList'));
    }


 public function showBK(string $id)
    {
        // Ambil data siswa
        $siswa = siswa::where('nis', $id)->first();

        if (!$siswa) {
            return redirect()->route('gurubk.siswa')->with('error', 'Siswa tidak ditemukan');
        }

        // Ambil langsung dari tabel siswa
        $poinPositif = $siswa->poin_apresiasi ?? 0;
        $poinNegatif = $siswa->poin_pelanggaran ?? 0;
        $poinTotal   = $siswa->poin_total ?? 0;

        // Ambil aktivitas terakhir siswa
        $activities = ActivityLog::where('nis', $siswa->nis)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('gurubk.siswa.show', [
            'siswa' => $siswa,
            'kelasList' => kelas::all(),
            'activities' => $activities,
            'poinPositif' => $poinPositif,
            'poinNegatif' => $poinNegatif,
            'poinTotal'   => $poinTotal,
        ]);
    }

}