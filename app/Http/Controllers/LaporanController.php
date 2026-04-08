<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanSkoringExport;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\ketua_program;
use Carbon\Carbon;

/**
 * Generator laporan siswa.
 * Produksi PDF/Excel pelanggaran, penghargaan, dan intervensi.
 */
class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan jam malam untuk Wakasek.
     */
    public function index()
{
    $user = Auth::user();

    // Default: tidak ada jurusanKetua
    $jurusanKetua = null;
    $walikelasId = null;

    // Jika role = 3 (ketua program)
    if ($user->role == 3) {

        // Ambil data ketua program berdasarkan username user
        $ketua = ketua_program::where('username', $user->username)->first();

        if (!$ketua) {
            abort(403, "Data Ketua Program tidak ditemukan.");
        }

        // Ambil jurusan dari ketua program
        $jurusanKetua = $ketua->jurusan;

        // Hanya tampilkan kelas sesuai jurusan ketua program
        $kelas = kelas::where('jurusan', $jurusanKetua)->get();

    } else {

        // Jika bukan ketua program → tampilkan semua kelas
        $kelas = kelas::all();
    }

    // Jika role = 4 (walikelas) ambil id_kelas walikelas untuk penggunaan default export
    if ($user->role == 4) {
        $walikelas = \App\Models\walikelas::where('username', $user->username)->first();
        if ($walikelas && $walikelas->id_kelas) {
            $walikelasId = $walikelas->id_kelas;
            // still pass kelas list (optional) — keep only walikelas class for clarity
            $kelas = kelas::where('id_kelas', $walikelasId)->get();
        } else {
            // jika walikelas tidak ditemukan, jangan crash — biarkan kelas tetap semua
            $walikelasId = null;
        }
    }

    return view('wakasek.laporan.index', compact('kelas', 'walikelasId'));
}


    public function exportPdf(Request $request)
    {
        try {
    $type      = $request->query('type');
    $kelas     = $request->query('kelas');
    $tingkat   = $request->query('tingkat');
    $jurusan   = $request->query('jurusan');
    $startDate = $request->query('start_date');
    $endDate   = $request->query('end_date');

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

    // Jika ada filter jurusan DAN tidak ada filter kelas → tetap pakai jurusan
    if ($jurusan && !$kelas) {
        $query->whereHas('siswa.kelas', fn($q) => $q->where('jurusan', $jurusan));
    }

    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay(),
        ]);
    }

    // Jika user adalah walikelas (role 4) dan user tidak memilih tanggal, batasi export ke kelas walikelas
    $user = Auth::user();
    if (!$startDate && !$endDate && $user && $user->role == 4) {
        $walikelas = \App\Models\walikelas::where('username', $user->username)->first();
        if ($walikelas && $walikelas->id_kelas) {
            $query->whereHas('siswa.kelas', fn($q) => $q->where('id_kelas', $walikelas->id_kelas));
            // update labels later by setting $kelas variable
            $kelas = $walikelas->id_kelas;
        }
    }

    $data = $query->get();

    // === PERBAIKAN DI SINI ===
    $kelasNama   = 'Semua Kelas';
    $jurusanNama = 'Semua Jurusan';

    if ($kelas) {
        $kelasModel = \App\Models\kelas::find($kelas);
        if ($kelasModel) {
            $kelasNama   = $kelasModel->nama_kelas;
            $jurusanNama = strtoupper($kelasModel->jurusan->id_jurusan);
        }
    } else if ($jurusan) {
        // Hanya jika tidak ada kelas, baru ambil dari parameter jurusan
        $jurusanNama = strtoupper($jurusan);
    }

    $pdf = Pdf::loadView('Export.laporan.laporan', [
        'data'       => $data,
        'type'       => $type,
        'kelas'      => $kelasNama,
        'tingkat'    => $tingkat ?: 'Semua Tingkat',
        'jurusan'    => $jurusanNama,
        'startDate'  => $startDate,
        'endDate'    => $endDate,
    ]);

    // Generate filename
    $fileName = 'laporan_' . $type;
    if ($startDate && $endDate) {
        $fileName .= '_' . $startDate . '_to_' . $endDate;
    }
    $fileName .= '.pdf';

    return $pdf->download($fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        try {
        $type = $request->query('type');
        $kelas = $request->query('kelas');
        $tingkat = $request->query('tingkat');
        $jurusan = $request->query('jurusan');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Jika user adalah walikelas (role 4) dan user tidak memilih tanggal, batasi export ke kelas walikelas
        $user = Auth::user();
        if (!$startDate && !$endDate && $user && $user->role == 4) {
            $walikelas = \App\Models\walikelas::where('username', $user->username)->first();
            if ($walikelas && $walikelas->id_kelas) {
                $kelas = $walikelas->id_kelas;
            }
        }

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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
