<?php

namespace App\Exports;

use App\Models\penghargaan;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Penghargaan_ExportExcel implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        return view('Export.penghargaan.excel', [
            'penghargaan' => penghargaan::all()
        ]);
    }
}

