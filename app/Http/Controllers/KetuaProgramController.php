<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ketua_program;
use App\Models\jurusan;
use Illuminate\Routing\Controller;
use App\Exports\Ketua_Program_ExportExcel;
use App\Imports\Ketua_Program_Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Kelola data ketua program.
 * CRUD akun ketua program dan keterkaitan jurusan.
 */
class KetuaProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = ketua_program::with('jurusan');

        if ($request->filled('jurusan')) {
            $query->where('id_jurusan', $request->jurusan);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_ketua_program', 'like', "%{$request->search}%")
                  ->orWhere('nip_kaprog', 'like', "%{$request->search}%");
            });
        }

        $ketua_program = $query->orderBy('id_jurusan')
                              ->orderBy('nama_ketua_program')
                              ->paginate(5)
                              ->appends($request->only(['jurusan', 'search']));

        $daftar_jurusan = jurusan::all();

        return view('wakasek.kaprog.index', compact('ketua_program', 'daftar_jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip_kaprog' => 'required|unique:ketua_program,nip_kaprog',
            'nama_ketua_program' => 'required|string|max:255',
            'id_jurusan' => 'required',
        ]);

        $user = User::create([
            'username' => $request->nama_ketua_program,
            'email' => strtolower(Str::slug($request->nama_ketua_program)) . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => 4,
        ]);

        ketua_program::create([
            'nip_kaprog' => $request->nip_kaprog,
            'nama_ketua_program' => $request->nama_ketua_program,
            'id_jurusan' => $request->id_jurusan,
            'username' => $user->username,
        ]);

        return redirect()->route('kaprog.index')->with('success', 'Data Ketua Program berhasil disimpan.');
    }

    public function edit($nip_kaprog)
    {
        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        $users = User::all();
        $daftar_jurusan = jurusan::pluck('nama_jurusan', 'id_jurusan');

        return view('wakasek.kaprog.edit', compact('kp', 'users', 'daftar_jurusan'));
    }

    public function update(Request $request, $nip_kaprog, $username)
    {
        $request->validate([
            'nip_kaprog' => 'required|unique:ketua_program,nip_kaprog,' . $nip_kaprog . ',nip_kaprog',
            'nama_ketua_program' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'id_jurusan' => 'required',
        ]);

        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();

        User::where('username', $username)->update([
            'username' => $request->username
        ]);

        $kp->update([
            'nip_kaprog' => $request->nip_kaprog,
            'nama_ketua_program' => $request->nama_ketua_program,
            'id_jurusan' => $request->id_jurusan,
            'username' => $request->username
        ]);

        return redirect()->route('kaprog.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($nip_kaprog)
    {
        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        User::where('username', $kp->username)->delete();
        $kp->delete();

        return redirect()->route('kaprog.index')->with('success', 'Data Ketua Program berhasil dihapus.');
    }

    public function export_pdf()
    {
        $ketua_program = ketua_program::with('jurusan')->get();

        $pdf = Pdf::loadView('Export.ketua_program.pdf', compact('ketua_program'));
        return $pdf->download('ketuaprogram.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new Ketua_Program_ExportExcel, 'ketuaprogram.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        Excel::import(new Ketua_Program_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Ketua Program berhasil diimport!');
    }
}
