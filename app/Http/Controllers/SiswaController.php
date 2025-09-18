<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

use App\Exports\Siswa_ExportExcel;
use App\Imports\Siswa_Import;
use App\Models\penghargaan;
use App\Models\siswa_penghargaan;
use App\Models\siswa_sp;
use App\Models\surat_peringatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jurusanList = kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = kelas::all();

        $penghargaanList = siswa_penghargaan::all();

        $query = siswa::query();

        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', fn($q) => $q->where('jurusan', $request->jurusan));
        }
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', fn($q) => $q->where('nama_kelas', $request->kelas));
        }

        $siswa = $query->paginate(10);

        return view('wakasek.siswa.index', compact('siswa', 'jurusanList', 'kelasList'));
    }

    public function fetchAPI()
    {
        $siswa = siswa::all();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil',
            'data'    => $siswa
        ], 200);
    }





    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required',
        ]);

        siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function Penghargaan(Request $request,string $nis)
    {
         $request->validate([
            'id_penghargaan' => 'required|string',
        ]);

        siswa_penghargaan::create([
            'nis' => $nis,
            'id_penghargaan' => $request->id_penghargaan,
        ]);

       return redirect()->back()->with('success', 'Penghargaan berhasil ditambahkan');

    }
    public function peringatan(Request $request,string $nis)
    {
         $request->validate([
            'id_sp' => 'required|string',
        ]);

        siswa_sp::create([
            'nis' => $nis,
            'id_sp' => $request->id_sp,
        ]);

        return redirect()->back()->with('success', 'Surat Peringatan berhasil ditambahkan');
    }


    /**
     * Show the detail of the student
     */
    public function show(string $id)
    {
        $siswa = siswa::where('nis', $id)->first();
        $penghargaan = penghargaan::all();
        $penghargaanList = siswa_penghargaan::all();
        $peringatan = surat_peringatan::all();
        $peringatanList = siswa_sp::all();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        }


        $poinPositif = $siswa->poin_apresiasi ?? 0;
        $poinNegatif = $siswa->poin_pelanggaran ?? 0;
        $poinTotal   = $siswa->poin_total ?? 0;


        $activities = ActivityLog::where('nis', $siswa->nis)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('wakasek.siswa.show', [
            'siswa' => $siswa,
            'kelasList' => Kelas::all(),
            'activities' => $activities,
            'poinPositif' => $poinPositif,
            'poinNegatif' => $poinNegatif,
            'poinTotal'   => $poinTotal,
            'penghargaanList' => $penghargaanList,
            'penghargaan' => $penghargaan,
            'peringatanList' => $peringatanList,
            'peringatan' => $peringatan,
        ]);
    }


    public function update(Request $request, $nis)
    {
        $request->validate([
            'nis' => 'required|integer',
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required|string',
        ]);

        $siswa = siswa::where('nis', $nis)->firstOrFail();

        $siswa->update([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
    public function destroyPenghargaan(string $nis,int $id)
    {
        $penghargaanList = siswa_penghargaan::where('id', $id)->where('nis', $nis)->first();
        if (!$penghargaanList) {
            return back()->with('error', 'Penghargaan tidak ditemukan');
        }

        $penghargaanList->delete();

        return back()->with('success', 'Penghargaan berhasil dihapus');
    }
    public function destroyPeringatan(string $nis,int $id)
    {
        $peringatanList = siswa_sp::where('id', $id)->where('nis', $nis)->first();
        if (!$peringatanList) {
            return back()->with('error', 'Penghargaan tidak ditemukan');
        }

        $peringatanList->delete();

        return back()->with('success', 'Penghargaan berhasil dihapus');
    }
      public function export_pdf()
    {
        $siswa = siswa::all();

        $pdf = PDF::loadView('export.siswa.pdf', compact('siswa'));
        return $pdf->download('siswa.pdf');

    }

    public function export_excel()
    {
        return Excel::download(new Siswa_ExportExcel, 'siswa.xlsx');
    }

      public function import(Request $request)
    {
        $siswa = siswa::all();

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Siswa_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Siswa berhasil diimport!');
    }







 

}
