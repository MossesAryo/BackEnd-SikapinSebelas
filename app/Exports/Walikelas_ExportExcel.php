<?php

namespace App\Exports;

use App\Models\walikelas;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Walikelas_ExportExcel implements FromView
{
    /**
    * @return \Illuminate\Contracts\View\View
    */
    public function view(): View
    {
        return view('export.walikelas.excel', [
            'walikelas' => Walikelas::all()
        ]);
    }
}
