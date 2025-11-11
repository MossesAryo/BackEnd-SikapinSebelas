<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\penilaian;
use Illuminate\Http\Request;
use App\Models\aspek_penilaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Skoring_PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = penilaian::whereHas('aspek_penilaian', function ($q) {
            $q->where('jenis_poin', 'Pelanggaran');
        });

      
        if ($request->filled('kelas')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_kelas', $request->kelas);
            });
        }

 
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

    
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('jenis_pelanggaran')) {
            $query->where('id_aspekpenilaian', $request->jenis_pelanggaran);
        }

        return view('wakasek.skoring.pelanggaran.index', [
            "penilaian" => $query->latest()->paginate(10)->withQueryString(),
            "siswa"     => siswa::all(),
            "aspekPel"  => aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get(),
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

        $user = Auth::user();
        $aspek   = aspek_penilaian::findOrFail($request->id_aspekpenilaian);
        $skor    = (int) $aspek->indikator_poin;
        $uraian  = $aspek->uraian;

        // Simpan penilaian
        penilaian::create([

            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,

            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'created_at'        => now(),

        ]);

        // Update poin siswa
        $siswa = siswa::where('nis', $request->nis)->first();
        $user = Auth::user();
        if ($siswa) {
            $siswa->poin_pelanggaran += $skor;
            $siswa->poin_total       -= $skor;
            $siswa->save();

            // Insert ke activity_logs
            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Tambah Pelanggaran',
                'description' => $uraian, // gunakan uraian aspek_penilaian
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('skoring_pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
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
        $skor    = $skoring->aspek_penilaian->indikator_poin ?? 0;
        $uraian  = $skoring->aspek_penilaian->uraian ?? '-';
        $user = Auth::user();

        if ($siswa) {
            $siswa->poin_pelanggaran -= $skor;
            $siswa->poin_total       += $skor;
            $siswa->save();

            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Hapus Pelanggaran',
                'description' => $uraian, // uraian aspek yang dihapus
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $skoring->delete();

        return redirect()->back()->with('success', 'Skoring berhasil dihapus!');
    }
}
