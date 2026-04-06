<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tahun_ajaran extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $id = 1;

        for ($tahun = 2020; $tahun <= 2040; $tahun++) {
            $data[] = [
                'id' => $id++,
                'tahun_ajaran' => $tahun . '/' . ($tahun + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tahun_ajaran')->insert($data);
    }
}
