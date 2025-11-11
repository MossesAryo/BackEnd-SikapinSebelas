<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GurubkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('guru_bk')->insert([
            [
                'nip_bk' => 198609262011012002,
                'username' => 'amel',
                'nama_guru_bk' => 'Raden Roro Siti Ameliya Purnama Putri, S.Pd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip_bk' => 199001102022212014,
                'username' => 'ratihpratiwi',
                'nama_guru_bk' => 'Ratih Pratiwi, S.Pd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip_bk' => 199205092022212021,
                'username' => 'suci',
                'nama_guru_bk' => 'Suci',
                'created_at' => now(),
                'updated_at' => now(),  
            ],
            [
                'nip_bk' => 199102222022212021,
                'username' => 'evifebry',
                'nama_guru_bk' => 'Evi Febry Damayanti, S.Pd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip_bk' => 196603172022212001,
                'username' => 'weningwigati',
                'nama_guru_bk' => 'Dra. Wening Wigati, S.E, M.Si',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
