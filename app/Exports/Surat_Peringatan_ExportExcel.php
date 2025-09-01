<?php

namespace App\Exports;

use App\Models\Surat_Peringatan;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Surat_Peringatan_ExportExcel implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        return view('export.peringatan.excel', [
            'surat_peringatan' => Surat_Peringatan::all()
        ]);
    }
}
