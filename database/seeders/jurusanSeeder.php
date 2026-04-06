<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['id_jurusan' => 'RPL', 'nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['id_jurusan' => 'PM', 'nama_jurusan' => 'Pemasaran'],
            ['id_jurusan' => 'AK', 'nama_jurusan' => 'Akuntansi'],
            ['id_jurusan' => 'TKJ', 'nama_jurusan' => 'Teknik Komputer dan Jaringan'],
            ['id_jurusan' => 'DKV', 'nama_jurusan' => 'Desain Komunikasi Visual'],
            ['id_jurusan' => 'MLOG', 'nama_jurusan' => 'Manajemen Logistik'],
            ['id_jurusan' => 'MP', 'nama_jurusan' => 'Manajemen Perkantoran'],   
        ];

        foreach ($data as $jurusan) {
            DB::table('jurusan')->insert(array_merge($jurusan, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
