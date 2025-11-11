<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\penilaian;
use Illuminate\Http\Request;
use App\Models\aspek_penilaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Skoring_PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = penilaian::whereHas('aspek_penilaian', function ($q) {
            $q->where('jenis_poin', 'Apresiasi');
        });

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_kelas', $request->kelas);
            });
        }

        // Filter berdasarkan tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        // Filter berdasarkan tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        // Filter berdasarkan jenis penghargaan
        if ($request->filled('jenis_penghargaan')) {
            $query->where('id_aspekpenilaian', $request->jenis_penghargaan);
        }

        // Sorting berdasarkan tanggal terbaru
        $query->latest();

        return view('wakasek.skoring.penghargaan.index', [
            "penilaian" => $query->paginate(10)->withQueryString(),
            "siswa"     => siswa::all(),
            "aspekPel"  => aspek_penilaian::where('jenis_poin', 'Apresiasi')->get(),
            "kelas"     => kelas::all(),
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
