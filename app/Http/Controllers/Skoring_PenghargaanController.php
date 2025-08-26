<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Penilaian;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Aspek_Penilaian;

class Skoring_PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.skoring.penghargaan.index', [
            "penilaian" => Penilaian::whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', 'Apresiasi');
            })->get(),
            "siswa" => Siswa::all(),
            "aspekPel" => Aspek_Penilaian::where('jenis_poin', 'Apresiasi')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required|unique:penilaian,id_penilaian',
            'nis' => 'required',
            'id_aspekpenilaian' => 'required',
            'skor' => 'required|numeric',
        ]);

        Penilaian::create([
            'id_penilaian' => $request->id_penilaian,
            'nis' => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'nip_wakasek' => null,
            'nip_walikelas' => null,
            'nip_bk' =>  null,
            'created_at' => now(),
        ]);

        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_apresiasi += $request->skor;
            $siswa->poin_total += $request->skor;
            $siswa->save();

            // 🔹 Tambahkan log aktivitas
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'nis'        => $siswa->nis, // simpan NIS siswa
                'activity'   => 'Tambah Penghargaan',
                'description' => "Penghargaan diberikan kepada {$siswa->nama_siswa} (NIS: {$siswa->nis}) dengan skor {$request->skor}",
            ]);
        }

        return redirect()->route('skoring_penghargaan.index')
            ->with('success', 'Data Skoring Penghargaan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
            'skor' => 'required|numeric',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $siswa = $penilaian->siswa;

        $oldSkor = $penilaian->aspek_penilaian->indikator_poin ?? 0;

        if ($siswa) {
            // rollback poin lama
            $siswa->poin_apresiasi -= $oldSkor;
            $siswa->poin_total -= $oldSkor;
        }

        // update data penilaian
        $penilaian->id_aspekpenilaian = $request->id_aspekpenilaian;
        $penilaian->save();

        // tambahkan poin baru
        if ($siswa) {
            $siswa->poin_apresiasi += $request->skor;
            $siswa->poin_total += $request->skor;
            $siswa->save();

            // log aktivitas
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'nis'        => $siswa->nis, // simpan NIS siswa
                'activity'   => 'Update Penghargaan',
                'description' => "Penghargaan untuk {$siswa->nama_siswa} (NIS: {$siswa->nis}) diubah. Skor lama {$oldSkor}, skor baru {$request->skor}",
            ]);
        }

        return redirect()->route('skoring_penghargaan.index')
            ->with('success', 'Data Skoring Penghargaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skoring = Penilaian::findOrFail($id);
        $siswa = $skoring->siswa;

        $skor = $skoring->aspek_penilaian->indikator_poin ?? 0;

        if ($siswa) {
            $siswa->poin_apresiasi -= $skor;
            $siswa->poin_total -= $skor;
            $siswa->save();

            // log aktivitas
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'nis'        => $siswa->nis, // simpan NIS siswa
                'activity'   => 'Hapus Penghargaan',
                'description' => "Penghargaan untuk {$siswa->nama_siswa} (NIS: {$siswa->nis}) dengan skor {$skor} dihapus",
            ]);
        }

        $skoring->delete();

        return redirect()->back()->with('success', 'Skoring berhasil dihapus!');
    }
}
