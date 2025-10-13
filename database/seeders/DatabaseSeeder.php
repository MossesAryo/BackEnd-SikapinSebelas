<?php

namespace Database\Seeders;

use App\Models\guru_bk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Aspek::class,
            UserSeeder::class,
            GurubkSeeder::class,
            PelanggaranSeeder::class,
            PenghargaanSeeder::class,
            KelasSeeder::class,
            guru_bk_kelas::class,
        ]);
    }
}
