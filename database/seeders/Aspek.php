<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Aspek extends Seeder
{
    public function run()
    {
        $data = [

            // ================== PELANGGARAN ==================
            // TERLAMBAT
            [
                'id_aspekpenilaian' => '1',
                'jenis_poin' => 'Pelanggaran',
                'kategori' => 'Terlambat',
                'uraian' => 'Terlambat 6-10 menit',
                'pelanggaran_ke' => 'I',
                'indikator_poin' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_aspekpenilaian' => '2',
                'jenis_poin' => 'Pelanggaran',
                'kategori' => 'Terlambat',
                'uraian' => 'Terlambat 6-10 menit',
                'pelanggaran_ke' => 'II',
                'indikator_poin' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_aspekpenilaian' => '3',
                'jenis_poin' => 'Pelanggaran',
                'kategori' => 'Terlambat',
                'uraian' => 'Terlambat 6-10 menit',
                'pelanggaran_ke' => 'III',
                'indikator_poin' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // KEHADIRAN
            [
                'id_aspekpenilaian' => '4',
                'jenis_poin' => 'Pelanggaran',
                'kategori' => 'Kehadiran',
                'uraian' => 'Alpa, tanpa keterangan apapun',
                'pelanggaran_ke' => 'I',
                'indikator_poin' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_aspekpenilaian' => '5',
                'jenis_poin' => 'Pelanggaran',
                'kategori' => 'Kehadiran',
                'uraian' => 'Alpa, tanpa keterangan apapun',
                'pelanggaran_ke' => 'II',
                'indikator_poin' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_aspekpenilaian' => '6',
                'jenis_poin' => 'Pelanggaran',
                'kategori' => 'Kehadiran',
                'uraian' => 'Alpa, tanpa keterangan apapun',
                'pelanggaran_ke' => 'III',
                'indikator_poin' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ================== APRESIASI ==================
            [
                'id_aspekpenilaian' => '7',
                'jenis_poin' => 'Apresiasi',
                'kategori' => 'Pengembangan Keagamaan',
                'uraian' => 'Melaksanakan praktik keagamaan sesuai agama & kepercayaan masing-masing',
                'pelanggaran_ke' => null,
                'indikator_poin' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_aspekpenilaian' => '8',
                'jenis_poin' => 'Apresiasi',
                'kategori' => 'Kejujuran',
                'uraian' => 'Menyampaikan / melaporkan barang temuan',
                'pelanggaran_ke' => null,
                'indikator_poin' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_aspekpenilaian' => '9',
                'jenis_poin' => 'Apresiasi',
                'kategori' => 'Prestasi Akademik',
                'uraian' => 'Meraih prestasi di tingkat sekolah',
                'pelanggaran_ke' => null,
                'indikator_poin' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('aspek_penilaian')->insert($data);
    }
}
