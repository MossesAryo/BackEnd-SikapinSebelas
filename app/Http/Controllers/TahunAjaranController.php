<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\tahunAjaran;
use Illuminate\Support\Facades\DB;

/**
 * Manajemen tahun ajaran.
 * CRUD periode akademik untuk data relasi.
 */
class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = tahunAjaran::orderBy('id', 'asc')->get();
        $tahunAktif  = tahunAjaran::where('status', 'aktif')->first();

        $preview = [
            'x_ke_xi'   => siswa::where('id_kelas', 'like', 'X-%')->where('status', 'aktif')->count(),
            'xi_ke_xii' => siswa::where('id_kelas', 'like', 'XI-%')->where('status', 'aktif')->count(),
            'lulus'     => siswa::where('id_kelas', 'like', 'XII-%')->where('status', 'aktif')->count(),
        ];

        return view('wakasek.tahun_ajaran.index', [
            'preview'     => $preview,
            'tahunAjaran' => $tahunAjaran,
            'tahunAktif'  => $tahunAktif,
        ]);
    }

    public function update(Request $request)
    {
        try {
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id'
        ]);

        $tahunBaru     = tahunAjaran::find($request->tahun_ajaran_id);
        $tahunSekarang = tahunAjaran::where('status', 'aktif')->first();

        if (!$tahunSekarang) {
            $tahunBaru->update(['status' => 'aktif']);
            return back()->with('success', 'Tahun ajaran berhasil diaktifkan.');
        }

        if ($tahunSekarang->id === $tahunBaru->id) {
            return back()->with('success', 'Tahun ajaran ini sudah aktif.');
        }

        $selisih = $tahunBaru->id - $tahunSekarang->id;

        DB::transaction(function () use ($selisih, $tahunSekarang, $tahunBaru) {
            if ($selisih > 0) {
                for ($i = 0; $i < $selisih; $i++) {
                    $this->naikKelas();
                }
            } elseif ($selisih < 0) {
                for ($i = 0; $i < abs($selisih); $i++) {
                    $this->turunKelas();
                }
            }

            $tahunSekarang->update(['status' => 'nonaktif']);
            $tahunBaru->update(['status' => 'aktif']);
        });

        return back()->with('success', 'Tahun ajaran berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function naikKelas(): void
    {
        try {
    // Proses XII dulu → alumni
    siswa::where('status', 'aktif')
        ->where('id_kelas', 'like', 'XII-%')
        ->each(function ($s) {
            [$tingkat, $jurusan, $nomor] = array_pad(explode('-', $s->id_kelas, 3), 3, null);
            if (!$jurusan || !$nomor) return;

            $s->id_kelas = null;
            $s->status   = 'alumni';
            $s->save();
        });

    // Lalu XI → XII
    siswa::where('status', 'aktif')
        ->where('id_kelas', 'like', 'XI-%')
        ->each(function ($s) {
            [$tingkat, $jurusan, $nomor] = array_pad(explode('-', $s->id_kelas, 3), 3, null);
            if (!$jurusan || !$nomor) return;

            $s->id_kelas = "XII-{$jurusan}-{$nomor}";
            $s->save();
        });

    // Terakhir X → XI
    siswa::where('status', 'aktif')
        ->where('id_kelas', 'like', 'X-%')
        ->each(function ($s) {
            [$tingkat, $jurusan, $nomor] = array_pad(explode('-', $s->id_kelas, 3), 3, null);
            if (!$jurusan || !$nomor) return;

            $s->id_kelas = "XI-{$jurusan}-{$nomor}";
            $s->save();
        });
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function turunKelas(): void
    {
        try {
    // Proses X dulu → tidak berubah, skip
    // XI → X dulu
    siswa::where('status', 'aktif')
        ->where('id_kelas', 'like', 'XI-%')
        ->each(function ($s) {
            [$tingkat, $jurusan, $nomor] = array_pad(explode('-', $s->id_kelas, 3), 3, null);
            if (!$jurusan || !$nomor) return;

            $s->id_kelas = "X-{$jurusan}-{$nomor}";
            $s->save();
        });

    // Lalu XII → XI
    siswa::where('status', 'aktif')
        ->where('id_kelas', 'like', 'XII-%')
        ->each(function ($s) {
            [$tingkat, $jurusan, $nomor] = array_pad(explode('-', $s->id_kelas, 3), 3, null);
            if (!$jurusan || !$nomor) return;

            $s->id_kelas = "XI-{$jurusan}-{$nomor}";
            $s->save();
        });
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
