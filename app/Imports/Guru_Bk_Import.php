<?php

namespace App\Imports;

use App\Models\guru_bk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Guru_Bk_Import implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new guru_bk([
        'nip_bk' => $row['nip_bk'],
        'username'      => $row['username'],
        'nama_guru_bk'=> $row['username'], 
        ]);
    }
}
