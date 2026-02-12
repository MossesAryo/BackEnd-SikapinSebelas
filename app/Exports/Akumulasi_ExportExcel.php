<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class Akumulasi_ExportExcel implements FromView
{
    protected Collection $rows;

    public function __construct(Collection $rows)
    {
        $this->rows = $rows;
    }

    public function view(): View
    {
        return view('Export.akumulasi.excel', [
            'akumulasi' => $this->rows
        ]);
    }
}