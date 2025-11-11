<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class guru_bk_kelas extends Seeder
{
    public function run(): void
    {
        /**
         * Mapping guru → daftar kelas yang dia pegang
         * (sesuai data dari kamu)
         */
        /**
         * Mapping guru → daftar kelas yang dia pegang
         */
        $data = [
            'Dra. Wening Wigati, S.E, M.Si' => [
                'X-AK-1', 'X-AK-2', 'X-AK-3',
                'X-DKV-1', 'X-DKV-2', 'X-TKJ-1',
                'XII-MP-1', 'XII-MP-2', 'XII-MP-3',
            ],
            'Ratih Pratiwi, S.Pd' => [
                'X-PM-1', 'X-PM-2', 'X-PM-3',
                'X-PPLG-1', 'X-PPLG-2',
                'XI-BR-1', 'XI-BR-2', 'XI-TKJ-1',
                'XII-TKJ-1',
            ],
            'Suci' => [
                'XI-MP-1', 'XI-MP-2', 'XI-MP-3',
                'XI-MLOG-1', 'XI-DKV-1', 'XI-DKV-2',
                'XII-BR-1', 'XII-BR-2', 'XII-BR-3',
            ],
            'Evi Febry Damayanti, S.Pd' => [
                'X-MPLB-1', 'X-MPLB-2', 'X-MPLB-3', 'X-MPLB-4',
                'XI-RPL-1', 'XI-RPL-2',
                'XII-RPL-1', 'XII-RPL-2',
            ],
            'Raden Roro Siti Ameliya Purnama Putri, S.Pd' => [
                'XI-AK-1', 'XI-AK-2', 'XI-AK-3', 'XI-AK-4',
                'XII-AK-1', 'XII-AK-2', 'XII-AK-3',
                'XII-DKV-1', 'XII-DKV-2',
            ],
        ];

        foreach ($data as $guruNama => $kelasList) {
            // ambil guru BK berdasarkan nama
            $guru = DB::table('guru_bk')->where('nama_guru_bk', $guruNama)->first();

            if (!$guru) {
                echo "⚠️  Guru BK '$guruNama' tidak ditemukan di tabel guru_bk.\n";
                continue;
            }

            foreach ($kelasList as $idKelas) {
                $kelas = DB::table('kelas')->where('id_kelas', $idKelas)->first();

                if (!$kelas) {
                    echo "⚠️  Kelas '$idKelas' tidak ditemukan di tabel kelas.\n";
                    continue;
                }

                DB::table('guru_bk_kelas')->insert([
                    'guru_bk_id' => $guru->nip_bk, // karena tabel guru_bk gak punya kolom id
                    'kelas_id'   => $kelas->id_kelas,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "✅ Seeder guru_bk_kelas selesai!\n";
    }
}
