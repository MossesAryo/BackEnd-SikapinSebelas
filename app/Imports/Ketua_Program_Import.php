<?php

namespace App\Imports;

use App\Models\ketua_program;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Ketua_Program_Import implements ToModel, WithHeadingRow
{
   
    public function model(array $row)
    {
        return new ketua_program([
        'nip_kaprog'=> $row['nip_kaprog'],
        'username'=> $row['username'],
        'nama_ketua_program'=> $row['nama_ketua_program'], 
        'jurusan'=> $row['jurusan'],
        ]);
    }
}
