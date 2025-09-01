<?php

namespace App\Exports;

use App\Models\guru_bk;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Guru_Bk_ExportExcel implements FromView
{
    /**
    * @return \Illuminate\Contracts\View\View
    */
    public function view(): View
    {
        return view('export.guru_bk.excel', [
            'guru_bk' => guru_bk::all()
        ]);
    }
}
