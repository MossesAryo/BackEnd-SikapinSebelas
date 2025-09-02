<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LaporanExport implements FromView
{
    protected $akumulasi;

    // Terima data siswa yang sudah difilter dari controller
    public function __construct($akumulasi)
    {
        $this->akumulasi = $akumulasi;
    }

    public function view(): View
    {
        return view('export.laporan.excel', [
            'akumulasi' => $this->akumulasi
        ]);
    }
}
