<?php

namespace App\Imports;

use App\Models\aspek_penilaian;
use Maatwebsite\Excel\Concerns\ToModel;

class Aspek_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new aspek_penilaian([
            //
        ]);
    }
}
