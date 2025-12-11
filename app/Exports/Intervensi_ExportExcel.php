<?php

namespace App\Exports;

use App\Models\intervensi;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Intervensi_ExportExcel implements FromView
{
    protected $collection;

    public function __construct($collection = null)
    {
        $this->collection = $collection;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $data = $this->collection ?? intervensi::with(['siswa.kelas'])->get();
        return view('Export.intervensi.excel', [
            'intervensi' => $data
        ]);
    }
}
