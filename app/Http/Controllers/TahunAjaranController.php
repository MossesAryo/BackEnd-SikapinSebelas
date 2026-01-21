<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $belumDiproses = Siswa::where('status', 'aktif')->exists();

        $preview = [
            'x_ke_xi' => 0,
            'xi_ke_xii' => 0,
            'alumni' => 0,
        ];

        if ($belumDiproses) {
            Siswa::where('status', 'aktif')->each(function ($siswa) use (&$preview) {

                if (str_starts_with($siswa->id_kelas, 'X-')) {
                    $preview['x_ke_xi']++;
                } elseif (str_starts_with($siswa->id_kelas, 'XI-')) {
                    $preview['xi_ke_xii']++;
                } elseif (str_starts_with($siswa->id_kelas, 'XII-')) {
                    $preview['alumni']++;
                }
            });
        }

        return view('wakasek.tahun_ajaran.index', [
            'preview' => $preview,
            'belumDiproses' => $belumDiproses
        ]);
    }


    public function proses()
    {
        DB::transaction(function () {

            Siswa::where('status', 'aktif')
                ->chunkById(100, function ($siswas) {

                    foreach ($siswas as $siswa) {

                        // ================= XII → ALUMNI =================
                        if (str_starts_with($siswa->id_kelas, 'XII-')) {
                            $siswa->update([
                                'status'   => 'alumni',
                                'id_kelas' => 'ALUMNI'
                            ]);
                            continue;
                        }

                        // ================= XI → XII =================
                        if (str_starts_with($siswa->id_kelas, 'XI-')) {
                            $nextIdKelas = str_replace('XI-', 'XII-', $siswa->id_kelas);
                        }
                        // ================= X → XI =================
                        elseif (str_starts_with($siswa->id_kelas, 'X-')) {
                            $nextIdKelas = str_replace('X-', 'XI-', $siswa->id_kelas);
                        } else {
                            continue;
                        }

                        // ================= VALIDASI KELAS =================
                        if (! Kelas::where('id_kelas', $nextIdKelas)->exists()) {
                            continue;
                        }

                        // ================= UPDATE SISWA =================
                        $siswa->update([
                            'id_kelas' => $nextIdKelas
                        ]);
                    }
                });
        });

        return redirect()
            ->route('tahun_ajaran.index')
            ->with('success', 'Kenaikan kelas berhasil diproses');
    }



    public function preview()
    {
        $data = [
            'x_ke_xi' => 0,
            'xi_ke_xii' => 0,
            'alumni' => 0,
        ];

        Siswa::where('status', 'aktif')->each(function ($siswa) use (&$data) {

            if (str_starts_with($siswa->id_kelas, 'X-')) {
                $data['x_ke_xi']++;
            } elseif (str_starts_with($siswa->id_kelas, 'XI-')) {
                $data['xi_ke_xii']++;
            } elseif (str_starts_with($siswa->id_kelas, 'XII-')) {
                $data['alumni']++;
            }
        });

        return $data;
    }
}
