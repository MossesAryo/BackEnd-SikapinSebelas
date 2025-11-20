<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\guru_bk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Exports\Guru_Bk_ExportExcel;
use App\Imports\Guru_Bk_Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Guru_bkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $query = guru_bk::with('kelas');


           // Search (nama atau nis)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_guru_bk', 'like', '%' . $search . '%')
                ->orWhere('nip_bk', 'like', '%' . $search . '%');
            });
        }
          // Paginate — sertakan semua query params yang relevan supaya pagination mempertahankan filter/search
    $guru_bk = $query->orderBy('nama_guru_bk')->paginate(10)
                  ->appends($request->only(['search', 'nip_bk', 'kelas']));


        return view('wakasek.guru_bk.index', [
            'guru_bk' => $guru_bk,
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
        $request->validate([
            'nip_bk' => 'required',
            'username' => 'required|string|max:255',
            'nama_guru_bk' => 'required|string|max:255',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => strtolower(Str::slug($request->username)) . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => 2
        ]);

        guru_bk::create([
            'nip_bk' => $request->nip_bk,
            'username' => $request->username,
            'nama_guru_bk' => $request->nama_guru_bk,
        ]);

        return redirect()->route('gurubk.index')->with('success', 'Guru BK berhasil ditambahkan');
    }

    public function update(Request $request, $nip_bk)
    {
        $request->validate([
            'nip_bk' => 'required',
            'username' => 'required',
            'nama_guru_bk' => 'required',
        ]);

        $bk = guru_bk::where('nip_bk', $nip_bk)->firstOrFail();


        User::where('username', $bk->username)->update([
            'username' => $request->username
        ]);

        $bk->update([
            'nip_bk' => $request->nip_bk,
            'username' => $request->username,
            'nama_guru_bk' => $request->nama_guru_bk,
        ]);

        return redirect()->route('gurubk.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $bk = guru_bk::findOrFail($id);

    User::where('username', $bk->username)->delete();

    $bk->delete();

    return redirect()->route('gurubk.index')->with('success', 'Guru BK dan user berhasil dihapus');
}

 public function export_pdf()
    {
        $guru_bk = guru_bk::all();

        $pdf = PDF::loadView('Export.guru_bk.pdf', compact('guru_bk'));
        return $pdf->download('guru_bk.pdf');

    }

    public function export_excel()
    {
        return Excel::download(new Guru_Bk_ExportExcel, 'guru_bk.xlsx');
    }

      public function import(Request $request)
    {
        $guru_bk = guru_bk::all();

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Guru_Bk_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Guru BK berhasil diimport!');
    }

}



