<?php

namespace App\Imports;

use App\Models\kelas;
use App\Models\siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Siswa_Import implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        if (empty($row[1]) || empty($row[2])) {
            return null;
        }
        if (str_starts_with($row[1], '=') || str_starts_with($row[3], '=')) {
            return null;
        }

        $idKelas = $row[3];

        $kelas = kelas::with('jurusan')->where('id_kelas', $idKelas)->first();
        $parts = explode('-', $idKelas);
        $kodeJurusan = $parts[1] ?? null;
        $mapping = [
            'BR'   => 'PM',   // sesuaikan kalau BR = Pemasaran
            'RPL'  => 'RPL',
            'TKJ'  => 'TKJ',
            'DKV'  => 'DKV',
            'AK'   => 'AK',
            'MLOG' => 'MLOG',
            'MP'   => 'MP',
            'PM'   => 'PM',
        ];

        $idJurusan = $mapping[$kodeJurusan] ?? null;
       

        return new siswa([
            'nis' => $row[1],
            'nama_siswa' => $row[2],
            'id_kelas' => $idKelas,
            'id_jurusan' => $idJurusan,
        ]);
    }
}
