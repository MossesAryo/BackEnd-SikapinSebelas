<?php

namespace App\Exports;

use App\Models\surat_peringatan;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Surat_Peringatan_ExportExcel implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        return view('Export.peringatan.excel', [
            'surat_peringatan' => surat_peringatan::all()
        ]);
    }
}
