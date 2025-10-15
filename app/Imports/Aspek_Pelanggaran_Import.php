<?php

namespace App\Imports;

use App\Models\aspek_penilaian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Aspek_Pelanggaran_Import implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
      
        return new aspek_penilaian([
            'jenis_poin'        => 'pelanggaran', 
            'kategori'          => $row['kategori'] ?? null,
            'uraian'            => $row['uraian'] ?? null,
            'pelanggaran_ke'    => $row['pelanggaran_ke'] ?? null,
            'indikator_poin'    => $row['poin'] ?? null,
        ]);
    }
}
