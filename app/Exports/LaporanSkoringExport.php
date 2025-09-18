<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LaporanSkoringExport implements FromCollection, WithHeadings, WithMapping
{
    protected $type;
    protected $kelas;
    protected $jurusan;

    public function __construct($type, $kelas, $jurusan)
    {
        $this->type = $type;
        $this->kelas = $kelas;
        $this->jurusan = $jurusan;
    }

    public function collection()
    {
        $query = Penilaian::with(['siswa.kelas', 'aspek_penilaian'])
            ->whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', $this->type === 'pelanggaran' ? 'Pelanggaran' : 'Apresiasi');
            });

        if ($this->kelas) {
            $query->whereHas('siswa.kelas', function ($q) {
                $q->where('id_kelas', $this->kelas);
            });
        }

        if ($this->jurusan) {
            $query->whereHas('siswa.kelas', function ($q) {
                $q->where('jurusan', $this->jurusan);
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama Siswa',
            'Kelas',
            $this->type === 'pelanggaran' ? 'Jenis Pelanggaran' : 'Jenis Penghargaan',
            'Skor',
            'Tanggal',
        ];
    }

    public function map($item): array
    {
        return [
            $item->siswa->nis ?? '-',
            $item->siswa->nama_siswa ?? '-',
            $item->siswa->kelas->nama_kelas ?? '-',
            $item->aspek_penilaian->kategori ?? '-',
            $item->aspek_penilaian->indikator_poin ?? 0,
            Carbon::parse($item->created_at)->format('Y-m-d'),
        ];
    }
}