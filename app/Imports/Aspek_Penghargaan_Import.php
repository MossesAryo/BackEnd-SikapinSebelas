<?php

namespace App\Imports;

use App\Models\aspek_penilaian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Aspek_Penghargaan_Import implements ToModel, WithHeadingRow
{

    // Heading ada di baris ke-2 (Excel 1-based)
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
            'indikator_poin'    => $row['poin'] ?? null,
        ]);
    }
}
