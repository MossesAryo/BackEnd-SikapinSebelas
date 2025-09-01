<?php

namespace App\Imports;

use App\Models\surat_peringatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Surat_Peringatan_Import implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new surat_peringatan([
            'id_sp'=> $row['kode'],
            'tanggal_sp'=> Date::excelToDateTimeObject($row['tanggal_surat_peringatan'])->format('Y-m-d'),
            'level_sp'=> $row['level_surat_peringatan'],
            'alasan'=> $row['alasan'],
        ]);
    }

}
