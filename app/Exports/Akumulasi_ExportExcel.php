<?php

namespace App\Exports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Akumulasi_ExportExcel implements FromView
{
    public function view(): View
    {
        return view('Export.akumulasi.excel', [
            'akumulasi' => \App\Models\siswa::with('kelas')->get()
        ]);
    }
}
