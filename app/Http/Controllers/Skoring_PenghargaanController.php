<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\penilaian;
use Illuminate\Http\Request;
use App\Models\aspek_penilaian;
use App\Models\ketua_program;
use App\Models\walikelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Skoring_PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $user = Auth::user();
    $jurusanKetua = null;
    $kelasWalikelas = null;

    // Query awal: hanya aspek Apresiasi
    $query = penilaian::whereHas('aspek_penilaian', function ($q) {
        $q->where('jenis_poin', 'Apresiasi');
    })->with(['siswa.kelas', 'aspek_penilaian']);

    // Jika user adalah ketua program
    if ($user->role == 3) {
        $ketua = ketua_program::where('username', $user->username)->first();

        if ($ketua && $ketua->jurusan) {
            $jurusanKetua = $ketua->jurusan;

            // Filter berdasarkan jurusan ketua
            $query->whereHas('siswa.kelas', function ($q) use ($jurusanKetua) {
                $q->where('jurusan', $jurusanKetua);
            });
        }
    }

    if ($user->role == 4) {
        $walikelas = walikelas::where('username', $user->username)->first();

        if ($walikelas && $walikelas->id_kelas) {
            $kelasWalikelas = $walikelas->id_kelas;

            // Filter berdasarkan jurusan ketua
            $query->whereHas('siswa.kelas', function ($q) use ($kelasWalikelas) {
                $q->where('id_kelas', $kelasWalikelas);
            });
        }
    }

    // Filter kelas
    if ($request->filled('kelas')) {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('id_kelas', $request->kelas);
        });
    }

    // Filter range tanggal
    if ($request->filled('tanggal_mulai')) {
        $query->whereDate('created_at', '>=', $request->tanggal_mulai);
    }

    if ($request->filled('tanggal_akhir')) {
        $query->whereDate('created_at', '<=', $request->tanggal_akhir);
    }

    // Filter jenis penghargaan
    if ($request->filled('jenis_penghargaan')) {
        $query->where('id_aspekpenilaian', $request->jenis_penghargaan);
    }

    // 🔥 SEARCH — HARUS Lewat Relasi siswa (karena nama_siswa bukan di tabel penilaian)
    if ($request->filled('search')) {
        $search = $request->search;

        $query->whereHas('siswa', function ($q) use ($search) {
            $q->where('nis', 'like', '%' . $search . '%')
              ->orWhere('nama_siswa', 'like', '%' . $search . '%');
        });
    }

    // Urutan data (terbaru dulu)
   $query->latest();

$penilaian = $query->paginate(10)->appends($request->all());

$kelasList = ($jurusanKetua)
    ? kelas::where('jurusan', $jurusanKetua)->get()
    : kelas::all();

$kelasListWalikelas = ($kelasWalikelas)
    ? kelas::where('id_kelas', $kelasWalikelas)->get()
    : kelas::all();

    $siswaList = siswa::with('kelas');

if ($user->role == 3 && $jurusanKetua) {
    // Kaprog hanya boleh melihat siswa dengan jurusan yang sama
    $siswaList->whereHas('kelas', function ($q) use ($jurusanKetua) {
        $q->where('jurusan', $jurusanKetua);
    });
}

if ($user->role == 4 && isset($kelasWalikelas)) {
    // Wali kelas hanya boleh melihat siswa kelasnya
    $siswaList->where('id_kelas', $kelasWalikelas);
}

$siswaList = $siswaList->orderBy('nama_siswa')->get();

return view('wakasek.skoring.penghargaan.index', [
    "penilaian"    => $penilaian,
    "siswa"        => $siswaList,
    "aspekPel"     => aspek_penilaian::where('jenis_poin', 'Apresiasi')->get(),
    "kelas"        => $kelasList,
    "jurusanKetua" => $jurusanKetua,
    "kelasWalikelas"    => $kelasListWalikelas,
]);

}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'nis'               => 'required',
            'id_aspekpenilaian' => 'required',
        ]);

        // Ambil skor & uraian dari aspek_penilaian
        $aspek  = aspek_penilaian::findOrFail($request->id_aspekpenilaian);
        $skor   = (int) $aspek->indikator_poin;
        $uraian = $aspek->uraian;
        $user   = Auth::user();

        // Simpan penilaian
        penilaian::create([
            
            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' =>  null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'created_at'        => now(),
        ]);

        // Update poin siswa
        $siswa = siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_apresiasi += $skor;
            $siswa->poin_total     += $skor;
            $siswa->save();

            // Simpan log aktivitas (pakai query builder agar kategori pasti tersimpan)
            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Apresiasi',
                'activity'    => 'Tambah Penghargaan',
                'description' => $uraian,   // uraian dari aspek_penilaian
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('skoring_penghargaan.index')
            ->with('success', 'Data penghargaan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skoring = penilaian::findOrFail($id);
        $siswa   = $skoring->siswa;
        $user = Auth::user();

        $skor   = $skoring->aspek_penilaian->indikator_poin ?? 0;
        $uraian = $skoring->aspek_penilaian->uraian ?? '-';

        if ($siswa) {
            $siswa->poin_apresiasi -= $skor;
            $siswa->poin_total     -= $skor;
            $siswa->save();

            // simpan log hapus
            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Apresiasi',
                'activity'    => 'Hapus Penghargaan',
                'description' => $uraian,
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // hapus penilaian
        $skoring->delete();

        return redirect()->back()->with('success', 'Penghargaan berhasil dihapus!');
    }
}
