<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class Skoring_Pelanggaran_ExportExcel implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Penilaian::with(['siswa', 'aspek_penilaian'])
            ->whereHas('aspek_penilaian', fn($q) => $q->where('jenis_poin', 'Pelanggaran'))
            ->get()
            ->map(fn($item) => [
                $item->siswa->nis ?? '-',
                $item->siswa->nama_siswa ?? '-',
                Carbon::parse($item->tanggal_pelanggaran ?? $item->created_at)->format('Y-m-d'),
                $item->aspek_penilaian->jenis_poin ?? '-',
                $item->aspek_penilaian->indikator_poin ?? 0,
            ]);
    }

    public function headings(): array
    {
        return ['NIS', 'Nama Siswa', 'Tanggal', 'Jenis Pelanggaran', 'Skor'];
    }
}
