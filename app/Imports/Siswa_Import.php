<?php

namespace App\Imports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Siswa_Import implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    return new siswa([
        'nis' => $row['nis'],
        'id_kelas'=> $row['id_kelas'],
        'nama_siswa'=> $row['nama_siswa'], 
        'poin_apresiasi	'=> $row['poin_apresiasi'],
        'poin_pelanggaran'=> $row['poin_pelanggaran'],
        'poin_total	'=> $row['poin_total'],
    ]);
}
}