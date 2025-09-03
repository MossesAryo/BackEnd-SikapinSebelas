<?php

namespace App\Http\Controllers;

use App\Exports\Aspek_Penghargaan_ExportExcel;
use App\Imports\Aspek_Penghargaan_Import;
use App\Exports\Aspek_Pelanggaran_ExportExcel;
use App\Imports\Aspek_Pelanggaran_Import;
use App\Models\aspek_penilaian;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Aspek_penilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // WAKASEKK
    public function index()
    {
        return view('wakasek.aspek_penilaian.aspek_penilaian', [
            'aspek_penilaian' => aspek_penilaian::get(),
        ]);
    }
    public function FetchApi()
    {
        $aspek_penilaian = aspek_penilaian::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Aspek Penilaian berhasil diambil',
            'data'    => $aspek_penilaian
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'indikator_poin' => 'required',
            'uraian' => 'required',
        ]);

        aspek_penilaian::create($request->all());
        return redirect()->route('aspekpenilaian')->with('success', 'Aspek Penilaian berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'indikator_poin' => 'required',
            'uraian' => 'required',
        ]);

        aspek_penilaian::find($id)->update($data);
        return redirect()->route('aspekpenilaian')->with('success', 'Aspek Penilaian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = aspek_penilaian::find($id)->delete();

        return redirect()->route('aspekpenilaian')->with('success', 'Aspek Penilaian berhasil dihapus');
    }




    public function indexPenghargaan(Request $request)
    {
        $query = aspek_penilaian::where('jenis_poin', 'Apresiasi');


        if ($request->filled('kategori')) {
            $query->where('kategori', 'LIKE', '%' . $request->kategori . '%');
        }

        $aspek_penilaian = $query->paginate(10);

        return view('wakasek.aspek_penilaian.aspek_penghargaan.index', compact('aspek_penilaian'));
    }

    public function storePenghargaan(Request $request)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'indikator_poin' => 'required',
        ]);

        aspek_penilaian::create([
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'jenis_poin' => $request->jenis_poin,
            'kategori' => $request->kategori,
            'uraian' => $request->uraian,
            'indikator_poin' => $request->indikator_poin,

        ]);


        return redirect()->route('aspek_penghargaan.index')->with('success', 'Aspek Penilaian berhasil ditambahkan');
    }

    public function updatePenghargaan(Request $request, string $id)
    {
        $data = $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'indikator_poin' => 'required',
        ]);

        $aspek_penilaian = aspek_penilaian::where('id_aspekpenilaian', $id)->firstOrFail();

        $aspek_penilaian->update([
            'id_aspekpenilaian' => $data['id_aspekpenilaian'],
            'jenis_poin' => $data['jenis_poin'],
            'kategori' => $data['kategori'],
            'uraian' => $data['uraian'],
        ]);

        return redirect()->route('aspek_penghargaan.index')->with('success', 'Aspek Penilaian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPenghargaan(string $id)
    {
        $data = aspek_penilaian::find($id)->delete();

        return redirect()->route('aspek_penghargaan.index')->with('success', 'Aspek Penilaian berhasil dihapus');
    }

    public function export_pdf()
    {
        $aspek_penilaian = aspek_penilaian::where('jenis_poin', 'Apresiasi')->get();

        $pdf = PDF::loadView('export.aspek_penghargaan.pdf', compact('aspek_penilaian'));
        return $pdf->download('aspek_penghargaan.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new Aspek_Penghargaan_ExportExcel, 'aspek_penghargaan.xlsx');
    }

    public function import(Request $request)
    {
        $aspek_penilaian = aspek_penilaian::where('jenis_poin', 'Apresiasi')->get();


        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Aspek_Penghargaan_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Aspek Penghargaan berhasil diimport!');
    }





    public function indexPelanggaran(Request $request)
    {
        $query = aspek_penilaian::where('jenis_poin', 'Pelanggaran');


        if ($request->filled('kategori')) {
            $query->where('kategori', 'like', '%' . $request->kategori . '%');
        }


        if ($request->filled('pelanggaran_ke')) {
            $query->where('pelanggaran_ke', $request->pelanggaran_ke);
        }

        // Bisa pagination biar rapih
        $aspek_penilaian = $query->paginate(10)->appends($request->all());

        return view('wakasek.aspek_penilaian.aspek_pelanggaran.index', compact('aspek_penilaian'));
    }




    public function storePelanggaran(Request $request)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'indikator_poin' => 'required',
        ]);

        aspek_penilaian::create([
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'jenis_poin' => $request->jenis_poin,
            'kategori' => $request->kategori,
            'uraian' => $request->uraian,
            'pelanggaran_ke' => $request->pelanggaran_ke,
            'indikator_poin' => $request->indikator_poin,

        ]);


        return redirect()->route('aspek_pelanggaran.index')->with('success', 'Aspek Penilaian berhasil ditambahkan');
    }

    public function updatePelanggaran(Request $request, string $id)
    {
        $data = $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'pelanggaran_ke' => 'required',
            'indikator_poin' => 'required',
        ]);

        $aspek_penilaian = aspek_penilaian::where('id_aspekpenilaian', $id)->firstOrFail();

        $aspek_penilaian->update([
            'id_aspekpenilaian' => $data['id_aspekpenilaian'],
            'jenis_poin' => $data['jenis_poin'],
            'kategori' => $data['kategori'],
            'uraian' => $data['uraian'],
            'pelanggaran_ke' => $data['pelanggaran_ke'],
            'indikator_poin' => $data['indikator_poin'],
        ]);

        return redirect()->route('aspek_pelanggaran.index')->with('success', 'Aspek Penilaian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPelanggaran(string $id)
    {
        $data = aspek_penilaian::find($id)->delete();

        return redirect()->route('aspek_pelanggaran.index')->with('success', 'Aspek Penilaian berhasil dihapus');
    }



     public function export_pelanggaran_pdf()
    {
        $aspek_penilaian = aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get();

        $pdf = PDF::loadView('export.aspek_pelanggaran.pdf', compact('aspek_penilaian'));
        return $pdf->download('aspek_pelanggaran.pdf');

    }

    public function export_pelanggaran_excel()
    {
        return Excel::download(new Aspek_Pelanggaran_ExportExcel, 'aspek_pelanggaran.xlsx');
    }

      public function import_pelanggaran(Request $request)
    {
        $aspek_penilaian = aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get();


        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Aspek_Pelanggaran_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Aspek Pelanggaran berhasil diimport!');
    }
     public function indexPenghargaanBK()
    {
        $aspek_penilaian = aspek_penilaian::where('jenis_poin', 'Apresiasi')->get();

        return view('gurubk.aspek_penilaian.aspek_penghargaan.index', compact('aspek_penilaian'));
    }

    public function storePenghargaanBK(Request $request)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'indikator_poin' => 'required',
        ]);

        aspek_penilaian::create([
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'jenis_poin' => $request->jenis_poin,
            'kategori' => $request->kategori,
            'uraian' => $request->uraian,
            'indikator_poin' => $request->indikator_poin,

        ]);


        return redirect()->route('aspek_penghargaanBK.index')->with('success', 'Aspek Penilaian berhasil ditambahkan');
    }

    public function updatePenghargaanBK(Request $request, string $id)
    {
        $data = $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'indikator_poin' => 'required',
        ]);

        $aspek_penilaian = aspek_penilaian::where('id_aspekpenilaian', $id)->firstOrFail();

        $aspek_penilaian->update([
            'id_aspekpenilaian' => $data['id_aspekpenilaian'],
            'jenis_poin' => $data['jenis_poin'],
            'kategori' => $data['kategori'],
            'uraian' => $data['uraian'],
        ]);

        return redirect()->route('aspek_penghargaanBK.index')->with('success', 'Aspek Penilaian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPenghargaanBK(string $id)
    {
        $data = aspek_penilaian::find($id)->delete();

        return redirect()->route('aspek_penghargaanBK.index')->with('success', 'Aspek Penilaian berhasil dihapus');
    }







    public function indexPelanggaranBK()
    {
        $aspek_penilaian = aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get();

        return view('gurubk.aspek_penilaian.aspek_pelanggaran.index', compact('aspek_penilaian'));
    }



    public function storePelanggaranBK(Request $request)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'indikator_poin' => 'required',
        ]);

        aspek_penilaian::create([
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'jenis_poin' => $request->jenis_poin,
            'kategori' => $request->kategori,
            'uraian' => $request->uraian,
            'pelanggaran_ke' => $request->pelanggaran_ke,
            'indikator_poin' => $request->indikator_poin,

        ]);


        return redirect()->route('aspek_pelanggaranBK.index')->with('success', 'Aspek Penilaian berhasil ditambahkan');
    }

    public function updatePelanggaranBK(Request $request, string $id)
    {
        $data = $request->validate([
            'id_aspekpenilaian' => 'required',
            'jenis_poin' => 'required',
            'kategori' => 'required',
            'uraian' => 'required',
            'pelanggaran_ke' => 'required',
            'indikator_poin' => 'required',
        ]);

        $aspek_penilaian = aspek_penilaian::where('id_aspekpenilaian', $id)->firstOrFail();

        $aspek_penilaian->update([
            'id_aspekpenilaian' => $data['id_aspekpenilaian'],
            'jenis_poin' => $data['jenis_poin'],
            'kategori' => $data['kategori'],
            'uraian' => $data['uraian'],
            'pelanggaran_ke' => $data['pelanggaran_ke'],
            'indikator_poin' => $data['indikator_poin'],
        ]);

        return redirect()->route('aspek_pelanggaraBK.index')->with('success', 'Aspek Penilaian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPelanggaranBK(string $id)
    {
        $data = aspek_penilaian::find($id)->delete();

        return redirect()->route('aspek_pelanggaranBK.index')->with('success', 'Aspek Penilaian berhasil dihapus');
    }

}


