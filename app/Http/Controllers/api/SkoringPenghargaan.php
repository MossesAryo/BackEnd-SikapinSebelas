<?php

namespace App\Http\Controllers\api;

use App\Models\siswa;
use App\Models\penilaian;
use Illuminate\Http\Request;
use App\Models\aspek_penilaian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SkoringPenghargaan extends Controller
{
    public function index()
    {
        $penilaian = penilaian::whereHas('aspek_penilaian', function ($q) {
            $q->where('jenis_poin', 'Apresiasi');
        })->paginate(10);

        $siswa    = siswa::all();
        $aspekPel = aspek_penilaian::where('jenis_poin', 'Apresiasi')->get();

        return response()->json([
            'penilaian' => $penilaian,
            'siswa'     => $siswa,
            'aspekPel'  => $aspekPel
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian'      => 'required|unique:penilaian,id_penilaian',
            'nis'               => 'required',
            'id_aspekpenilaian' => 'required',
        ]);

        $aspek  = aspek_penilaian::findOrFail($request->id_aspekpenilaian);
        $skor   = (int) $aspek->indikator_poin;
        $uraian = $aspek->uraian;
        $user   = $request->user(); 

        $penilaian = penilaian::create([
            'id_penilaian'      => $request->id_penilaian,
            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'nip_bk'            => $user->gurubk->nip_bk ?? null,
            'nip_walikelas'     => null,
            'nip_wakasek'       => $user->wakasek->nip_wakasek ?? null,
            'created_at'        => now(),
        ]);

        $siswa = siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_apresiasi += $skor;
            $siswa->poin_total     += $skor;
            $siswa->save();

            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Apresiasi',
                'activity'    => 'Tambah Penghargaan',
                'description' => $uraian,
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return response()->json([
            'message' => 'Data penghargaan berhasil ditambahkan.',
            'data'    => $penilaian
        ], 201);
    }
}
