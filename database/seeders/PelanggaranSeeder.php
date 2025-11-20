<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('surat_peringatan')->insert([
            [
                'id_sp' => '1',
                'tanggal_sp' => '2025-02-05',
                'level_sp' => 'SP1',
                'alasan' => 'Surat Peringatan 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sp' => '2',
                'tanggal_sp' => '2025-03-20',
                'level_sp' => 'SP2',
                'alasan' => 'Surat Peringatan 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sp' => '3',
                'tanggal_sp' => '2025-05-15',
                'level_sp' => 'SP3',
                'alasan' => 'Surat Peringatan 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
