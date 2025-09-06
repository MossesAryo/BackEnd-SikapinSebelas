<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\Aspek_Penilaian;
use Illuminate\Support\Facades\DB;

class Skoring_PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        

        return view('wakasek.skoring.pelanggaran.index', [
            // ambil penilaian yg aspeknya bertipe Pelanggaran
            "penilaian" => Penilaian::whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', 'Pelanggaran');
            })->get(),
            "siswa"    => Siswa::all(),
            "aspekPel" => Aspek_Penilaian::where('jenis_poin', 'Pelanggaran')->get(),   
            
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
        $aspek   = Aspek_Penilaian::findOrFail($request->id_aspekpenilaian);
        $skor    = (int) $aspek->indikator_poin;
        $uraian  = $aspek->uraian;

        // Simpan penilaian
        Penilaian::create([
            'id_penilaian'      => $request->id_penilaian,
            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,

            'nip_wakasek'       => null,
            'nip_walikelas'     => null,
            'nip_bk'            => null,
            'created_at'        => now(),

        ]);

        // Update poin siswa
        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_pelanggaran += $skor;
            $siswa->poin_total       -= $skor;
            $siswa->save();

            // Insert ke activity_logs
            DB::table('activity_logs')->insert([
                'user_id'     => auth()->id(),
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $siswa     = $penilaian->siswa;

        // rollback skor lama
        $oldSkor = $penilaian->aspek_penilaian->indikator_poin ?? 0;
        if ($siswa) {
            $siswa->poin_pelanggaran -= $oldSkor;
            $siswa->poin_total       += $oldSkor;
        }

        // aspek baru
        $aspekBaru = Aspek_Penilaian::findOrFail($request->id_aspekpenilaian);
        $newSkor   = (int) $aspekBaru->indikator_poin;
        $uraian    = $aspekBaru->uraian;

        // update penilaian
        $penilaian->id_aspekpenilaian = $request->id_aspekpenilaian;
        $penilaian->save();

        if ($siswa) {
            $siswa->poin_pelanggaran += $newSkor;
            $siswa->poin_total       -= $newSkor;
            $siswa->save();

            DB::table('activity_logs')->insert([
                'user_id'     => auth()->id(),
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Update Pelanggaran',
                'description' => $uraian, // uraian aspek baru
                'point'       => $newSkor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('skoring_pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skoring = Penilaian::findOrFail($id);
        $siswa   = $skoring->siswa;
        $skor    = $skoring->aspek_penilaian->indikator_poin ?? 0;
        $uraian  = $skoring->aspek_penilaian->uraian ?? '-';

        if ($siswa) {
            $siswa->poin_pelanggaran -= $skor;
            $siswa->poin_total       += $skor;
            $siswa->save();

            DB::table('activity_logs')->insert([
                'user_id'     => auth()->id(),
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