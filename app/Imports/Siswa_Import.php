<?php
namespace App\Imports;

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
        // Manual skip empty rows
        if (empty($row[1]) || empty($row[2])) {
            return null;
        }
        
        // Skip jika masih formula
        if (str_starts_with($row[1], '=') || str_starts_with($row[3], '=')) {
            return null;
        }

        return new siswa([
            'nis' => $row[1],
            'nama_siswa' => $row[2],
            'id_kelas' => $row[3],
        ]);
    }
}