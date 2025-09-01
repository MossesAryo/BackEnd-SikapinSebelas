<?php

namespace App\Imports;

use App\Models\penghargaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Penghargaan_Import implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penghargaan([
            'id_penghargaan'     => $row['kode'],
            'tanggal_penghargaan' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_surat_penghargaan'])->format('Y-m-d'),
            'level_penghargaan'  => $row['level_penghargaan'],
            'alasan'             => $row['alasan'],
        ]);
    }
}
