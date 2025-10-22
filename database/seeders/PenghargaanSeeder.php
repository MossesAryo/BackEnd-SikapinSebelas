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
                'alasan' => 'Penghargaan 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penghargaan' => '2',
                'tanggal_penghargaan' => '2025-03-10',
                'level_penghargaan' => 'PH2',
                'alasan' => 'Penghargaan 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penghargaan' => '3',
                'tanggal_penghargaan' => '2025-06-01',
                'level_penghargaan' => 'PH3',
                'alasan' => 'Penghargaan 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
