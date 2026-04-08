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
        if (!isset($row['kategori']) || $row['kategori'] == null) {
            return null;
        }

        return new aspek_penilaian([
            'jenis_poin'        => 'pelanggaran',
            'kategori'          => $row['kategori'] ?? null,
            'uraian'            => $row['uraian'] ?? null,
            'pelanggaran_ke'    => $this->convertToRoman($row['pelanggaran_ke'] ?? null),
            'indikator_poin'    => $row['poin'] ?? null,
        ]);
    }
    private function convertToRoman($value)
    {
        if (!$value) {
            return null;
        }

        $value = trim((string) $value);

        $map = [
            '1' => 'I',
            '2' => 'II',
            '3' => 'III',
            '4' => 'IV',
            '5' => 'V',
        ];

        return $map[$value] ?? strtoupper($value);
    }
}
