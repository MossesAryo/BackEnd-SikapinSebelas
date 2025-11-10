<?php

namespace App\Exports;

use App\Models\ketua_program;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Ketua_Program_ExportExcel implements FromView
{
   
    public function view(): View
    {
        return view('Export.ketua_program.excel', [
            'ketua_program' => ketua_program::all()
        ]);
    }
}
