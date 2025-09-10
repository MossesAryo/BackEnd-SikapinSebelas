<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\Aspek_Penilaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Skoring_PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.skoring.penghargaan.index', [
            // Ambil semua penilaian yang aspek- nya bertipe Apresiasi
            "penilaian"   => Penilaian::whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', 'Apresiasi');
            })->paginate(10),
            "siswa"       => Siswa::all(),
            // Kirim dengan nama aspekPel agar view tidak error
            "aspekPel"    => Aspek_Penilaian::where('jenis_poin', 'Apresiasi')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian'      => 'required|unique:penilaian,id_penilaian',
            'nis'               => 'required',
            'id_aspekpenilaian' => 'required',
        ]);

        // Ambil skor & uraian dari aspek_penilaian
        $aspek  = Aspek_Penilaian::findOrFail($request->id_aspekpenilaian);
        $skor   = (int) $aspek->indikator_poin;
        $uraian = $aspek->uraian;
        $user = Auth::user();

        // Simpan penilaian
        Penilaian::create([
            'id_penilaian'      => $request->id_penilaian,
            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'created_at'        => now(),
        ]);

        // Update poin siswa
        $siswa = Siswa::where('nis', $request->nis)->first();
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $siswa     = $penilaian->siswa;
        $user = Auth::user();

        // Skor lama (ambil dari aspek yang saat ini terhubung)
        $oldSkor = $penilaian->aspek_penilaian->indikator_poin ?? 0;
        if ($siswa) {
            // rollback nilai lama
            $siswa->poin_apresiasi -= $oldSkor;
            $siswa->poin_total     -= $oldSkor;
        }

        // Ambil aspek baru & uraian
        $aspekBaru = Aspek_Penilaian::findOrFail($request->id_aspekpenilaian);
        $newSkor   = (int) $aspekBaru->indikator_poin;
        $uraian    = $aspekBaru->uraian;

        // Update penilaian
        $penilaian->id_aspekpenilaian = $request->id_aspekpenilaian;
        $penilaian->save();

        if ($siswa) {
            // tambahkan skor baru
            $siswa->poin_apresiasi += $newSkor;
            $siswa->poin_total     += $newSkor;
            $siswa->save();

            // simpan log update
            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Apresiasi',
                'activity'    => 'Update Penghargaan',
                'description' => $uraian,
                'point'       => $newSkor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('skoring_penghargaan.index')
            ->with('success', 'Data penghargaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skoring = Penilaian::findOrFail($id);
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
