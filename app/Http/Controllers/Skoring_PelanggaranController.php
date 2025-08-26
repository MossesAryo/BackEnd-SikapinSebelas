<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Penilaian;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Aspek_Penilaian;

class Skoring_PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.skoring.pelanggaran.index', [
            "penilaian" => Penilaian::whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', 'Pelanggaran');
            })->get(),
            "siswa" => Siswa::all(),
            "aspekPel" => Aspek_Penilaian::where('jenis_poin', 'Pelanggaran')->get()
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
            $siswa->poin_pelanggaran += $request->skor;
            $siswa->poin_total -= $request->skor;
            $siswa->save();

            // 🔹 Tambahkan log aktivitas
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'nis'        => $siswa->nis, // simpan NIS siswa
                'activity'   => 'Tambah Pelanggaran',
                'description' => "Pelanggaran dicatat untuk {$siswa->nama_siswa} (NIS: {$siswa->nis}) dengan skor {$request->skor}",
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
            'skor' => 'required|numeric',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $siswa = $penilaian->siswa;

        $oldSkor = $penilaian->aspek_penilaian->indikator_poin ?? 0;

        if ($siswa) {
            // rollback poin lama
            $siswa->poin_pelanggaran -= $oldSkor;
            $siswa->poin_total += $oldSkor;
        }

        // update data penilaian
        $penilaian->id_aspekpenilaian = $request->id_aspekpenilaian;
        $penilaian->save();

        // tambahkan poin baru
        if ($siswa) {
            $siswa->poin_pelanggaran += $request->skor;
            $siswa->poin_total -= $request->skor;
            $siswa->save();

            // log aktivitas
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'nis'        => $siswa->nis, // simpan NIS siswa
                'activity'   => 'Update Pelanggaran',
                'description' => "Pelanggaran untuk {$siswa->nama_siswa} (NIS: {$siswa->nis}) diubah. Skor lama {$oldSkor}, skor baru {$request->skor}",
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
        $siswa = $skoring->siswa;

        $skor = $skoring->aspek_penilaian->indikator_poin ?? 0;

        if ($siswa) {
            $siswa->poin_pelanggaran -= $skor;
            $siswa->poin_total += $skor;
            $siswa->save();

            // log aktivitas
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'nis'        => $siswa->nis, // simpan NIS siswa
                'activity'   => 'Hapus Pelanggaran',
                'description' => "Pelanggaran untuk {$siswa->nama_siswa} (NIS: {$siswa->nis}) dengan skor {$skor} dihapus",
            ]);
        }

        $skoring->delete();

        return redirect()->back()->with('success', 'Skoring berhasil dihapus!');
    }
}
