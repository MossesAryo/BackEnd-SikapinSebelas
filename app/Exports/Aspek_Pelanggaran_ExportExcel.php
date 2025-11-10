<?php

namespace App\Exports;

use App\Models\aspek_penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Aspek_Pelanggaran_ExportExcel implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('Export.aspek_pelanggaran.excel', [
            'aspek_penilaian' => aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get()
        ]);
    }
}
