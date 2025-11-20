<?php

namespace App\Imports;

use App\Models\penghargaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Penghargaan_Import implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $rawLevel = trim(strtoupper($row['level_penghargaan']));

        // Hilangkan karakter non-alfanumerik tersembunyi
        $cleanLevel = preg_replace('/[^A-Z0-9]/', '', $rawLevel);

        $mapping = [
            '1' => 'PH1',
            '2' => 'PH2',
            '3' => 'PH3',
            'PH1' => 'PH1',
            'PH2' => 'PH2',
            'PH3' => 'PH3',
        ];

        $level = $mapping[$cleanLevel] ?? 'PH3'; // Default ke PH3 jika tidak ditemukan

        $tanggal = null;
        if (!empty($row['tanggal']) && is_numeric($row['tanggal'])) {
            $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
        }
        return new Penghargaan([
            'tanggal_penghargaan' => $tanggal,
            'level_penghargaan'   => $level,
            'alasan'              => $row['uraian'] ?? '',
        ]);
    }
}
