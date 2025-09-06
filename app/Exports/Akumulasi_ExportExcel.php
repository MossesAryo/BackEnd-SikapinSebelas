<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Akumulasi_ExportExcel implements FromView
{
    public function view(): View
    {
        return view('export.akumulasi.excel', [
            'akumulasi' => \App\Models\Siswa::with('kelas')->get()
        ]);
    }
}
