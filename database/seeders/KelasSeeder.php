<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_kelas' => 'X-RPL-1', 'nama_kelas' => 'Kelas X RPL 1', 'jurusan' => 'RPL'],
            ['id_kelas' => 'X-RPL-2', 'nama_kelas' => 'Kelas X RPL 2', 'jurusan' => 'RPL'],

            ['id_kelas' => 'X-PM-1', 'nama_kelas' => 'Kelas X PM 1', 'jurusan' => 'PM'],
            ['id_kelas' => 'X-PM-2', 'nama_kelas' => 'Kelas X PM 2', 'jurusan' => 'PM'],
            ['id_kelas' => 'X-PM-3', 'nama_kelas' => 'Kelas X PM 3', 'jurusan' => 'PM'],

            ['id_kelas' => 'X-AK-1', 'nama_kelas' => 'Kelas X AK 1', 'jurusan' => 'AK'],
            ['id_kelas' => 'X-AK-2', 'nama_kelas' => 'Kelas X AK 2', 'jurusan' => 'AK'],
            ['id_kelas' => 'X-AK-3', 'nama_kelas' => 'Kelas X AK 3', 'jurusan' => 'AK'],

            ['id_kelas' => 'X-TKJ-1', 'nama_kelas' => 'Kelas X TKJ 1', 'jurusan' => 'TKJ'],
            ['id_kelas' => 'X-TKJ-2', 'nama_kelas' => 'Kelas X TKJ 2', 'jurusan' => 'TKJ'],

            ['id_kelas' => 'X-DKV-1', 'nama_kelas' => 'Kelas X DKV 1', 'jurusan' => 'DKV'],
            ['id_kelas' => 'X-DKV-2', 'nama_kelas' => 'Kelas X DKV 2', 'jurusan' => 'DKV'],

            ['id_kelas' => 'X-MLOG-1', 'nama_kelas' => 'Kelas X MLOG 1', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'X-MLOG-2', 'nama_kelas' => 'Kelas X MLOG 2', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'X-MLOG-3', 'nama_kelas' => 'Kelas X MLOG 3', 'jurusan' => 'MLOG'],

            ['id_kelas' => 'X-MP-1', 'nama_kelas' => 'Kelas X MP 1', 'jurusan' => 'MP'],
            ['id_kelas' => 'X-MP-2', 'nama_kelas' => 'Kelas X MP 2', 'jurusan' => 'MP'],
            ['id_kelas' => 'X-MP-3', 'nama_kelas' => 'Kelas X MP 3', 'jurusan' => 'MP'],
        ];

        foreach ($data as $kelas) {
            DB::table('kelas')->insert(array_merge($kelas, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
