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
           
            ['id_kelas' => 'X-RPL-1', 'nama_kelas' => 'X RPL 1', 'jurusan' => 'RPL'],
            ['id_kelas' => 'X-RPL-2', 'nama_kelas' => 'X RPL 2', 'jurusan' => 'RPL'],

            
            ['id_kelas' => 'XI-RPL-1', 'nama_kelas' => 'XI RPL 1', 'jurusan' => 'RPL'],
            ['id_kelas' => 'XI-RPL-2', 'nama_kelas' => 'XI RPL 2', 'jurusan' => 'RPL'],

            
            ['id_kelas' => 'XII-RPL-1', 'nama_kelas' => 'XII RPL 1', 'jurusan' => 'RPL'],
            ['id_kelas' => 'XII-RPL-2', 'nama_kelas' => 'XII RPL 2', 'jurusan' => 'RPL'],


        
            ['id_kelas' => 'X-PM-1', 'nama_kelas' => 'X PM 1', 'jurusan' => 'PM'],
            ['id_kelas' => 'X-PM-2', 'nama_kelas' => 'X PM 2', 'jurusan' => 'PM'],
            ['id_kelas' => 'X-PM-3', 'nama_kelas' => 'X PM 3', 'jurusan' => 'PM'],

          
            ['id_kelas' => 'XI-PM-1', 'nama_kelas' => 'XI PM 1', 'jurusan' => 'PM'],
            ['id_kelas' => 'XI-PM-2', 'nama_kelas' => 'XI PM 2', 'jurusan' => 'PM'],
            ['id_kelas' => 'XI-PM-3', 'nama_kelas' => 'XI PM 3', 'jurusan' => 'PM'],

           
            ['id_kelas' => 'XII-PM-1', 'nama_kelas' => 'XII PM 1', 'jurusan' => 'PM'],
            ['id_kelas' => 'XII-PM-2', 'nama_kelas' => 'XII PM 2', 'jurusan' => 'PM'],
            ['id_kelas' => 'XII-PM-3', 'nama_kelas' => 'XII PM 3', 'jurusan' => 'PM'],


    
            ['id_kelas' => 'X-AK-1', 'nama_kelas' => 'X AK 1', 'jurusan' => 'AK'],
            ['id_kelas' => 'X-AK-2', 'nama_kelas' => 'X AK 2', 'jurusan' => 'AK'],
            ['id_kelas' => 'X-AK-3', 'nama_kelas' => 'X AK 3', 'jurusan' => 'AK'],

        
            ['id_kelas' => 'XI-AK-1', 'nama_kelas' => 'XI AK 1', 'jurusan' => 'AK'],
            ['id_kelas' => 'XI-AK-2', 'nama_kelas' => 'XI AK 2', 'jurusan' => 'AK'],
            ['id_kelas' => 'XI-AK-3', 'nama_kelas' => 'XI AK 3', 'jurusan' => 'AK'],

 
            ['id_kelas' => 'XII-AK-1', 'nama_kelas' => 'XII AK 1', 'jurusan' => 'AK'],
            ['id_kelas' => 'XII-AK-2', 'nama_kelas' => 'XII AK 2', 'jurusan' => 'AK'],
            ['id_kelas' => 'XII-AK-3', 'nama_kelas' => 'XII AK 3', 'jurusan' => 'AK'],


        
            ['id_kelas' => 'X-TKJ-1', 'nama_kelas' => 'X TKJ 1', 'jurusan' => 'TKJ'],
            ['id_kelas' => 'X-TKJ-2', 'nama_kelas' => 'X TKJ 2', 'jurusan' => 'TKJ'],

            // XI TKJ
            ['id_kelas' => 'XI-TKJ-1', 'nama_kelas' => 'XI TKJ 1', 'jurusan' => 'TKJ'],
            ['id_kelas' => 'XI-TKJ-2', 'nama_kelas' => 'XI TKJ 2', 'jurusan' => 'TKJ'],

            // XII TKJ
            ['id_kelas' => 'XII-TKJ-1', 'nama_kelas' => 'XII TKJ 1', 'jurusan' => 'TKJ'],
            ['id_kelas' => 'XII-TKJ-2', 'nama_kelas' => 'XII TKJ 2', 'jurusan' => 'TKJ'],


            // X DKV
            ['id_kelas' => 'X-DKV-1', 'nama_kelas' => 'X DKV 1', 'jurusan' => 'DKV'],
            ['id_kelas' => 'X-DKV-2', 'nama_kelas' => 'X DKV 2', 'jurusan' => 'DKV'],

            // XI DKV
            ['id_kelas' => 'XI-DKV-1', 'nama_kelas' => 'XI DKV 1', 'jurusan' => 'DKV'],
            ['id_kelas' => 'XI-DKV-2', 'nama_kelas' => 'XI DKV 2', 'jurusan' => 'DKV'],

            // XII DKV
            ['id_kelas' => 'XII-DKV-1', 'nama_kelas' => 'XII DKV 1', 'jurusan' => 'DKV'],
            ['id_kelas' => 'XII-DKV-2', 'nama_kelas' => 'XII DKV 2', 'jurusan' => 'DKV'],


            // X MLOG
            ['id_kelas' => 'X-MLOG-1', 'nama_kelas' => 'X MLOG 1', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'X-MLOG-2', 'nama_kelas' => 'X MLOG 2', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'X-MLOG-3', 'nama_kelas' => 'X MLOG 3', 'jurusan' => 'MLOG'],

            // XI MLOG
            ['id_kelas' => 'XI-MLOG-1', 'nama_kelas' => 'XI MLOG 1', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'XI-MLOG-2', 'nama_kelas' => 'XI MLOG 2', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'XI-MLOG-3', 'nama_kelas' => 'XI MLOG 3', 'jurusan' => 'MLOG'],

            // XII MLOG
            ['id_kelas' => 'XII-MLOG-1', 'nama_kelas' => 'XII MLOG 1', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'XII-MLOG-2', 'nama_kelas' => 'XII MLOG 2', 'jurusan' => 'MLOG'],
            ['id_kelas' => 'XII-MLOG-3', 'nama_kelas' => 'XII MLOG 3', 'jurusan' => 'MLOG'],


            // X MP
            ['id_kelas' => 'X-MP-1', 'nama_kelas' => 'X MP 1', 'jurusan' => 'MP'],
            ['id_kelas' => 'X-MP-2', 'nama_kelas' => 'X MP 2', 'jurusan' => 'MP'],
            ['id_kelas' => 'X-MP-3', 'nama_kelas' => 'X MP 3', 'jurusan' => 'MP'],

            // XI MP
            ['id_kelas' => 'XI-MP-1', 'nama_kelas' => 'XI MP 1', 'jurusan' => 'MP'],
            ['id_kelas' => 'XI-MP-2', 'nama_kelas' => 'XI MP 2', 'jurusan' => 'MP'],
            ['id_kelas' => 'XI-MP-3', 'nama_kelas' => 'XI MP 3', 'jurusan' => 'MP'],

            
            ['id_kelas' => 'XII-MP-1', 'nama_kelas' => 'XII MP 1', 'jurusan' => 'MP'],
            ['id_kelas' => 'XII-MP-2', 'nama_kelas' => 'XII MP 2', 'jurusan' => 'MP'],
            ['id_kelas' => 'XII-MP-3', 'nama_kelas' => 'XII MP 3', 'jurusan' => 'MP'],
        ];

        foreach ($data as $kelas) {
            DB::table('kelas')->insert(array_merge($kelas, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
