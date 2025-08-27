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
        // Filter: hanya import data dengan jenis_poin = Apresiasi
        if (strtolower(trim($row['jenis_poin'])) !== 'apresiasi') {
            return null;
        }

        return new aspek_penilaian([
            'id_aspekpenilaian' => $row['kode'],
            'jenis_poin'        => $row['jenis_poin'],
            'kategori'          => $row['kategori'],
            'uraian'            => $row['uraian'],
            'indikator_poin'    => $row['poin'],
        ]);
    }
}
