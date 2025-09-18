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
                'alasan' => 'Sering terlambat masuk kelas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sp' => '2',
                'tanggal_sp' => '2025-03-20',
                'level_sp' => 'SP2',
                'alasan' => 'Tidak mengerjakan tugas berulang kali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sp' => '3',
                'tanggal_sp' => '2025-05-15',
                'level_sp' => 'SP3',
                'alasan' => 'Membolos lebih dari 3 kali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
