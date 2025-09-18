<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenghargaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('penghargaan')->insert([
            [
                'id_penghargaan' => '1',
                'tanggal_penghargaan' => '2025-01-15',
                'level_penghargaan' => 'PH1',
                'alasan' => 'Disiplin dalam kehadiran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penghargaan' => '2',
                'tanggal_penghargaan' => '2025-03-10',
                'level_penghargaan' => 'PH2',
                'alasan' => 'Prestasi lomba tingkat kota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penghargaan' => '3',
                'tanggal_penghargaan' => '2025-06-01',
                'level_penghargaan' => 'PH3',
                'alasan' => 'Aktif dalam kegiatan OSIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
