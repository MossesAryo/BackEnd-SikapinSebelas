<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.siswa.index', [
            'siswa' => Siswa::all(),
            'kelas' => Kelas::all()
        ]);
    }
    public function fetchAPI(){
        $siswa = siswa::all();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil',
            'data'    => $siswa
        ], 200);
    }

    public function siswaGuruBk()
    {
        return view('gurubk.siswa', [
            'siswa' => Siswa::all(),
            'kelas' => Kelas::all()
        ]);
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Show the detail of the student
     */
    public function show(string $id)
    {
        // Ambil data siswa
        $siswa = Siswa::where('nis', $id)->first();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
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

        return view('wakasek.siswa.show', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'activities' => $activities,
            'poinPositif' => $poinPositif,
            'poinNegatif' => $poinNegatif,
            'poinTotal'   => $poinTotal,
        ]);
    }


    public function update(Request $request, $nis)
    {
        $request->validate([
            'nis' => 'required|integer',
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required|string',
        ]);

        $siswa = Siswa::where('nis', $nis)->firstOrFail();

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
}
