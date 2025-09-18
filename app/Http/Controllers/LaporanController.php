<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanSkoringExport;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan jam malam untuk Wakasek.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('wakasek.laporan.index', compact('kelas'));
    }

    public function exportPdf(Request $request)
    {
        $type = $request->query('type');
        $kelas = $request->query('kelas');
        $tingkat = $request->query('tingkat');
        $jurusan = $request->query('jurusan');

        $query = Penilaian::with(['siswa.kelas', 'aspek_penilaian'])
            ->whereHas('aspek_penilaian', function ($q) use ($type) {
                $q->where('jenis_poin', $type === 'pelanggaran' ? 'Pelanggaran' : 'Apresiasi');
            });

        if ($kelas) {
            $query->whereHas('siswa.kelas', function ($q) use ($kelas) {
                $q->where('id_kelas', $kelas);
            });
        }

        if ($tingkat) {
            $query->whereHas('siswa.kelas', function ($q) use ($tingkat) {
                $q->where('tingkat', $tingkat);
            });
        }

        if ($jurusan) {
            $query->whereHas('siswa.kelas', function ($q) use ($jurusan) {
                $q->where('jurusan', $jurusan);
            });
        }

        $data = $query->get();

        $pdf = Pdf::loadView('Export.laporan.laporan', [
            'data' => $data,
            'type' => $type,
            'kelas' => $kelas ? Kelas::find($kelas)->nama_kelas : 'Semua Kelas',
            'tingkat' => $tingkat ?: 'Semua Tingkat',
            'jurusan' => $jurusan ?: 'Semua Jurusan',
        ]);

        return $pdf->download('laporan_' . $type . '_' . now()->format('YmdHis') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $type = $request->query('type');
        $kelas = $request->query('kelas');
        $tingkat = $request->query('tingkat');
        $jurusan = $request->query('jurusan');

        return Excel::download(new LaporanSkoringExport($type, $kelas, $tingkat, $jurusan), 'laporan_' . $type . '_' . now()->format('YmdHis') . '.xlsx');
    }
}
