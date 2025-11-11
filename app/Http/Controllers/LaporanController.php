<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanSkoringExport;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan jam malam untuk Wakasek.
     */
    public function index()
    {
        $kelas = kelas::all();
        return view('wakasek.laporan.index', compact('kelas'));
    }

    public function exportPdf(Request $request)
    {
        $type = $request->query('type');
        $kelas = $request->query('kelas');
        $tingkat = $request->query('tingkat');
        $jurusan = $request->query('jurusan');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = penilaian::with(['siswa.kelas', 'aspek_penilaian'])
            ->whereHas('aspek_penilaian', function ($q) use ($type) {
                $q->where('jenis_poin', $type === 'pelanggaran' ? 'Pelanggaran' : 'Apresiasi');
            });

        if ($kelas) {
            $query->whereHas('siswa.kelas', fn($q) => $q->where('id_kelas', $kelas));
        }

        if ($tingkat) {
            $query->whereHas('siswa.kelas', fn($q) => $q->where('tingkat', $tingkat));
        }

        if ($jurusan) {
            $query->whereHas('siswa.kelas', fn($q) => $q->where('jurusan', $jurusan));
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ]);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('Export.laporan.laporan', [
            'data' => $data,
            'type' => $type,
            'kelas' => $kelas ? kelas::find($kelas)->nama_kelas : 'Semua Kelas',
            'tingkat' => $tingkat ?: 'Semua Tingkat',
            'jurusan' => $jurusan ?: 'Semua Jurusan',
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        // Generate dynamic filename
        $fileName = 'laporan_' . $type;
        if ($startDate && $endDate) {
            $fileName .= '_' . $startDate . '_to_' . $endDate;
        }
        $fileName .= '.pdf';

        return $pdf->download($fileName);
    }

    public function exportExcel(Request $request)
    {
        $type = $request->query('type');
        $kelas = $request->query('kelas');
        $tingkat = $request->query('tingkat');
        $jurusan = $request->query('jurusan');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Generate dynamic filename
        $fileName = 'laporan_' . $type;
        if ($startDate && $endDate) {
            $fileName .= '_' . $startDate . '_to_' . $endDate;
        }
        $fileName .= '.xlsx';

        return Excel::download(
            new LaporanSkoringExport($type, $kelas, $tingkat, $jurusan, $startDate, $endDate),
            $fileName
        );
    }
}
