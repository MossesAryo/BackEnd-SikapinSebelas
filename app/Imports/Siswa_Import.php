<?php

namespace App\Imports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Siswa_Import implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 2;
    }
    public function model(array $row)
{
    return new siswa([
        'nis' => $row['nis'],
        'id_kelas'=> $row['id_kelas'],
        'nama_siswa'=> $row['nama_siswa'], 
      
    ]);
}
}