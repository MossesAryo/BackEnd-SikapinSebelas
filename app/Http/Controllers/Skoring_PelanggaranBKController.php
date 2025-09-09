<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\Aspek_Penilaian;
use Illuminate\Support\Facades\DB;

use App\Exports\Skoring_Pelanggaran_ExportExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Skoring_PelanggaranBKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');
        $kelasList   = Kelas::all();
        $siswa   = Siswa::all();
        $aspekPel = Aspek_Penilaian::where('jenis_poin', 'pelanggaran')->get();

        $penilaianQuery = Penilaian::whereHas('aspek_penilaian', function ($q) {
            $q->where('jenis_poin', 'Pelanggaran');
        });

        // Filter berdasarkan jurusan -> cek relasi Penilaian -> Siswa -> Kelas
        if ($request->filled('jurusan')) {
            $penilaianQuery->whereHas('siswa', function ($q) use ($request) {
                $q->whereHas('kelas', function ($k) use ($request) {
                    $k->where('jurusan', $request->jurusan);
                });
            });
        }

        // Filter berdasarkan nama_kelas
        if ($request->filled('kelas')) {
            $penilaianQuery->whereHas('siswa', function ($q) use ($request) {
                $q->whereHas('kelas', function ($k) use ($request) {
                    $k->where('nama_kelas', $request->kelas);
                });
            });
        }

        // eager load relasi yg akan dipakai di view dan paginate
        $penilaian = $penilaianQuery->with(['siswa.kelas', 'aspek_penilaian'])
            ->paginate(10)
            ->appends($request->query());


        return view('gurubk.skoring.pelanggaran.index', compact('siswa', 'aspekPel', 'penilaian', 'jurusanList', 'kelasList'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian'      => 'required|unique:penilaian,id_penilaian',
            'nis'               => 'required',
            'id_aspekpenilaian' => 'required',
        ]);

        // Ambil skor & uraian dari aspek_penilaian
        $aspek   = Aspek_Penilaian::findOrFail($request->id_aspekpenilaian);
        $skor    = (int) $aspek->indikator_poin;
        $uraian  = $aspek->uraian;
        $user = auth()->user();

        Penilaian::create([
            'id_penilaian'      => $request->id_penilaian,
            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,

            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,

            'created_at'    => now(),
        ]);

        
        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_pelanggaran += $skor;
            $siswa->poin_total       -= $skor;
            $siswa->save();

            // Insert ke activity_logs
            DB::table('activity_logs')->insert([
                'user_id'     => auth()->id(),
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Tambah Pelanggaran',
                'description' => $uraian,
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('skoring_pelanggaranBK.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_aspekpenilaian' => 'required',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $siswa     = $penilaian->siswa;

        // rollback skor lama
        $oldSkor = $penilaian->aspek_penilaian->indikator_poin ?? 0;
        if ($siswa) {
            $siswa->poin_pelanggaran -= $oldSkor;
            $siswa->poin_total       += $oldSkor;
        }

        // aspek baru
        $aspekBaru = Aspek_Penilaian::findOrFail($request->id_aspekpenilaian);
        $newSkor   = (int) $aspekBaru->indikator_poin;
        $uraian    = $aspekBaru->uraian;

        // update penilaian
        $penilaian->id_aspekpenilaian = $request->id_aspekpenilaian;
        $penilaian->save();

        if ($siswa) {
            $siswa->poin_pelanggaran += $newSkor;
            $siswa->poin_total       -= $newSkor;
            $siswa->save();

            DB::table('activity_logs')->insert([
                'user_id'     => auth()->id(),
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Update Pelanggaran',
                'description' => $uraian, // uraian aspek baru
                'point'       => $newSkor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('skoring_pelanggaranBK.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skoring = Penilaian::findOrFail($id);
        $siswa   = $skoring->siswa;
        $skor    = $skoring->aspek_penilaian->indikator_poin ?? 0;
        $uraian  = $skoring->aspek_penilaian->uraian ?? '-';

        if ($siswa) {
            $siswa->poin_pelanggaran -= $skor;
            $siswa->poin_total       += $skor;
            $siswa->save();

            DB::table('activity_logs')->insert([
                'user_id'     => auth()->id(),
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Hapus Pelanggaran',
                'description' => $uraian, // uraian aspek yang dihapus
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $skoring->delete();

        return redirect()->back()->with('success', 'Skoring berhasil dihapus!');
    }

    public function export_excel()
    {
        return Excel::download(new Skoring_Pelanggaran_ExportExcel, 'skoring_pelanggaran.xlsx');
    }

    public function export_pdf()
    {
        $data = \App\Models\Penilaian::with(['siswa', 'aspek_penilaian'])
            ->whereHas('aspek_penilaian', function ($q) {
                $q->where('jenis_poin', 'Pelanggaran');
            })
            ->get();

        $pdf = Pdf::loadView('export.skoring_pelanggaran.pdf', compact('data'));
        return $pdf->download('skoring_pelanggaran.pdf');
    }
}
