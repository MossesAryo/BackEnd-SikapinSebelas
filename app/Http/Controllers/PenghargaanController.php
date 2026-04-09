<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penghargaan;

use App\Exports\Penghargaan_ExportExcel;
use App\Imports\Penghargaan_Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Pengelolaan penghargaan siswa.
 * CRUD poin apresiasi serta cetak laporan.
 */
class PenghargaanController extends Controller
{

public function index(Request $request)
{
    $query = penghargaan::query();

    // SEARCH
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('tanggal_penghargaan', 'like', "%{$request->search}%")
              ->orWhere('level_penghargaan', 'like', "%{$request->search}%")
              ->orWhere('alasan', 'like', "%{$request->search}%");
        });
    }

    // HARUS PAKAI paginate() — BUKAN get()!
    $penghargaan = $query->orderBy('tanggal_penghargaan', 'asc')
                         ->paginate(10) // atau 10, 15, sesuai keinginan
                         ->appends($request->only('search')); // biar search tetap di URL

    return view('wakasek.penghargaan.index', compact('penghargaan'));
}

    public function fetchApi(){
        $penghargaan = penghargaan::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Penghargaan berhasil diambil',
            'data'    => $penghargaan
        ], 200);
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'level_penghargaan' => 'required|in:PH1,PH2,PH3',
            'alasan' => 'required|string|max:255',
        ]);
       penghargaan::create([
            'tanggal_penghargaan' =>  now()->format('Y-m-d') ,
            'level_penghargaan' => $request->level_penghargaan ,
            'alasan' => $request->alasan,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function update(Request $request, $id_penghargaan)
    {
        try {
        $request->validate([
            'level_penghargaan' => 'required|in:PH1,PH2,PH3',
            'alasan' => 'required|string|max:255',
        ]);

        $data = [

            'tanggal_penghargaan' => now()->format('Y-m-d') ,
            'level_penghargaan' => $request->level_penghargaan ,
            'alasan' => $request->alasan,
        ];

        $updated = penghargaan::where('id_penghargaan', $id_penghargaan)->update($data);

        return redirect()->route('penghargaan.index')->with('success', 'Penghargaan berhasil diedit.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }


    public function destroy($id)
    {
        try {
        $penghargaan = penghargaan::findOrFail($id);
        $penghargaan->delete();

        return redirect()->route('penghargaan.index')->with('success', 'Data penghargaan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }


    public function export_pdf()
    {
        try {
        $penghargaan = penghargaan::all();

        $pdf = PDF::loadView('Export.penghargaan.pdf', compact('penghargaan'));
        return $pdf->download('penghargaan.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function export_excel()
    {
        try {
        return Excel::download(new Penghargaan_ExportExcel, 'penghargaan.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function import(Request $request)
    {
        try {
        $penghargaan = penghargaan::all();

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Penghargaan_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data penghargaan berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }
}
