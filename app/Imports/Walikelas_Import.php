<?php

namespace App\Imports;

use App\Models\Walikelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Walikelas_Import implements ToModel, WithHeadingRow
{
  public function model(array $row)
{
    return new Walikelas([
        'nip_walikelas' => $row['nip_walikelas'],
        'username'      => $row['username'],
        'nama_walikelas'=> $row['username'], 
        'id_kelas'      => $row['id_kelas'],
    ]);
}

}