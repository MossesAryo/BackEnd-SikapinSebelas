<?php

namespace App\Exports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Siswa_ExportExcel implements FromView
{
    /**
    * @return \Illuminate\Contracts\View\View
    */
    public function view(): View
    {
        return view('Export.siswa.excel', [
            'siswa' => siswa::all()
        ]);
    }
}
