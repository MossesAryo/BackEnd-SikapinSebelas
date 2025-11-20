<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

use App\Exports\Siswa_ExportExcel;
use App\Imports\Siswa_Import;
use App\Models\aspek_penilaian;
use Illuminate\Support\Facades\DB;
use App\Models\penilaian;
use App\Models\intervensi;


use App\Models\guru_bk;
use App\Models\penghargaan;
use App\Models\siswa_penghargaan;
use App\Models\siswa_sp;
use App\Models\ketua_program;
use App\Models\surat_peringatan;
use App\Models\walikelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    // Data dropdown / helper
    $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');
    $kelasList   = Kelas::select('id_kelas', 'nama_kelas', 'jurusan')->get();
    $penghargaanList = siswa_penghargaan::all();

    // Mulai query siswa dengan eager load kelas
    $query = Siswa::with('kelas');

    // Jika login guru BK -> batasi ke kelas yang dipegang
    if (Auth::user()->role === 'guru_bk') {
        $guruBk = guru_bk::where('user_id', Auth::id())->first();
        if ($guruBk) {
            $kelasIds = $guruBk->kelas->pluck('id_kelas')->toArray();
            if (!empty($kelasIds)) {
                $query->whereIn('kelas_id', $kelasIds);
            } else {
                // Jika guru BK tidak pegang kelas sama sekali, kembalikan hasil kosong secara aman
                $siswa = collect([])->paginate(10); // fallback (optional)
                return view('wakasek.siswa.index', compact('siswa', 'jurusanList', 'kelasList', 'penghargaanList'));
            }
        }
    }

    // Search (nama atau nis)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_siswa', 'like', '%' . $search . '%')
              ->orWhere('nis', 'like', '%' . $search . '%');
        });
    }

    // Filter jurusan -> lewat relasi kelas
    if ($request->filled('jurusan')) {
        $query->whereHas('kelas', function ($q) use ($request) {
            $q->where('jurusan', $request->jurusan);
        });
    }

    // Filter kelas spesifik
    if ($request->filled('kelas')) {
        $query->where('kelas_id', $request->kelas);
    }

    // Paginate — sertakan semua query params yang relevan supaya pagination mempertahankan filter/search
    $siswa = $query->orderBy('nama_siswa')->paginate(10)
                  ->appends($request->only(['search', 'jurusan', 'kelas']));

    return view('wakasek.siswa.index', compact('siswa', 'jurusanList', 'kelasList', 'penghargaanList'));
}






    public function fetchAPI()
    {
        $siswa = siswa::all();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil',
            'data'    => $siswa
        ], 200);
    }

  public function siswa_ketua_program(Request $request)
{
    $user = Auth::user();

    // Ambil data ketua program termasuk jurusan
    $ketua = ketua_program::where('username', $user->username)->first();

    if (!$ketua) {
        abort(403, "Data Ketua Program tidak ditemukan.");
    }

    $jurusanKetua = $ketua->jurusan;

    // Query siswa yang jurusannya sama dengan ketua program
    $query = siswa::with('kelas')
        ->whereHas('kelas', function ($q) use ($jurusanKetua) {
            $q->where('jurusan', $jurusanKetua);
        });

    // Filter kelas
    if ($request->filled('kelas')) {
        $query->where('id_kelas', $request->kelas);
    }

    // Search (nama atau nis)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_siswa', 'like', '%' . $search . '%')
              ->orWhere('nis', 'like', '%' . $search . '%');
        });
    }

    $siswa = $query->orderBy('nama_siswa')->paginate(10)
                   ->appends($request->only(['search', 'kelas']));

    // List kelas sesuai jurusan ketua program
    $kelasList = kelas::where('jurusan', $jurusanKetua)->get();

    return view('wakasek.siswa.index', compact('siswa', 'kelasList'));
}



   public function siswa_walikelas(Request $request)
{
    $user = Auth::user();

    $walikelas = walikelas::where('username', $user->username)->first();

    if (!$walikelas) {
        abort(403, "Data Walikelas tidak ditemukan.");
    }

    // Ambil jurusan ketua program
    $kelasWalikelas = $walikelas->id_kelas;

    // Query siswa
    $query = siswa::with('kelas')
        ->whereHas('kelas', function ($q) use ($kelasWalikelas) {
            $q->where('id_kelas', $kelasWalikelas);
        });

    // Filter berdasarkan kelas
    if ($request->filled('kelas')) {
        $query->where('id_kelas', $request->kelas);
    }

     // Search (nama atau nis)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_siswa', 'like', '%' . $search . '%')
              ->orWhere('nis', 'like', '%' . $search . '%');
        });
    }

    $siswa = $query->orderBy('nama_siswa')->paginate(10)
                   ->appends($request->only(['search', 'kelas']));

    // List kelas jurusan ketua program
    $kelasList = kelas::where('id_kelas', $kelasWalikelas)->get();

    return view('wakasek.siswa.index', compact('siswa', 'kelasList'));
}



    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required',
        ]);

        siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

        public function Penghargaan(Request $request,string $nis)
        {
            $request->validate([
                'id_penghargaan' => 'required|string',
            ]);

            siswa_penghargaan::create([
                'nis' => $nis,
                'id_penghargaan' => $request->id_penghargaan,
            ]);

        return redirect()->back()->with('success', 'Penghargaan berhasil ditambahkan');

        }
    public function peringatan(Request $request,string $nis)
    {
         $request->validate([
            'id_sp' => 'required|string',
        ]);

        siswa_sp::create([
            'nis' => $nis,
            'id_sp' => $request->id_sp,
        ]);

        return redirect()->back()->with('success', 'Surat Peringatan berhasil ditambahkan');
    }


    /**
     * Show the detail of the student
     */
    public function show(string $nis)
    {
        $siswa = siswa::where('nis', $nis)->first();
        $penghargaan = penghargaan::all();
        $penghargaanList = siswa_penghargaan::all();
        $peringatan = surat_peringatan::all();
        $skoringpenghargaan = aspek_penilaian::where('jenis_poin', 'Apresiasi')->get();
        $skoringpelanggaran = aspek_penilaian::where('jenis_poin', 'Pelanggaran')->get();
        $peringatanList = siswa_sp::all();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        }


        $poinPositif = $siswa->poin_apresiasi ?? 0;
        $poinNegatif = $siswa->poin_pelanggaran ?? 0;
        $poinTotal   = $siswa->poin_total ?? 0;


        $activities = ActivityLog::where('nis', $siswa->nis)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('wakasek.siswa.show', [
            'siswa' => $siswa,
            'kelasList' => kelas::all(),
            'activities' => $activities,
            'poinPositif' => $poinPositif,
            'poinNegatif' => $poinNegatif,
            'poinTotal'   => $poinTotal,
            'penghargaanList' => $penghargaanList,
            'penghargaan' => $penghargaan,
            'peringatanList' => $peringatanList,
            'peringatan' => $peringatan,
            'skoringpenghargaan' => $skoringpenghargaan,
            'skoringpelanggaran' => $skoringpelanggaran,
        ]);
    }


    public function update(Request $request, $nis)
    {
        $request->validate([
            'nis' => 'required|integer',
            'nama_siswa' => 'required|string',
            'id_kelas' => 'required|string',
        ]);

        $siswa = siswa::where('nis', $nis)->firstOrFail();

        $siswa->update([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $nis)
    {
        $siswa = siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
    public function destroyPenghargaan(string $nis,int $id)
    {
        $penghargaanList = siswa_penghargaan::where('id', $id)->where('nis', $nis)->first();
        if (!$penghargaanList) {
            return back()->with('error', 'Penghargaan tidak ditemukan');
        }

        $penghargaanList->delete();

        return back()->with('success', 'Penghargaan berhasil dihapus');
    }
    public function destroyPeringatan(string $nis,int $id)
    {
        $peringatanList = siswa_sp::where('id', $id)->where('nis', $nis)->first();
        if (!$peringatanList) {
            return back()->with('error', 'Penghargaan tidak ditemukan');
        }

        $peringatanList->delete();

        return back()->with('success', 'Penghargaan berhasil dihapus');
    }
      public function exportPdf(Request $request)
{
    $query = siswa::with('kelas');

    if ($request->filled('jurusan')) {
        $query->whereHas('kelas', function ($q) use ($request) {
            $q->where('jurusan', $request->jurusan);
        });
    }

    if ($request->filled('kelas')) {
        $query->where('id_kelas', $request->kelas);
    }

    $siswa = $query->get();

    $pdf = Pdf::loadView('wakasek.siswa.pdf', compact('siswa'));
    return $pdf->download('Data_Siswa.pdf');
}

   public function exportExcel(Request $request)
{
    $query = siswa::with('kelas');

    if ($request->filled('jurusan')) {
        $query->whereHas('kelas', function ($q) use ($request) {
            $q->where('jurusan', $request->jurusan);
        });
    }

    if ($request->filled('kelas')) {
        $query->where('id_kelas', $request->kelas);
    }

    $siswa = $query->get();

    return Excel::download(new Siswa_ExportExcel($siswa), 'Data_Siswa.xlsx');
}

      public function import(Request $request)
    {
        $siswa = siswa::all();

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',

        ]);

        Excel::import(new Siswa_Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Siswa berhasil diimport!');
    }

    public function naikKelasSemua()
{
    $semuaKelas = Kelas::all();

    foreach ($semuaKelas as $kelasAsal) {
        $kelasTujuan = null;

        if (str_starts_with($kelasAsal->id_kelas, 'X-')) {
        
            $kelasTujuan = str_replace('X-', 'XI-', $kelasAsal->id_kelas);
        } elseif (str_starts_with($kelasAsal->id_kelas, 'XI-')) {
         
            $kelasTujuan = str_replace('XI-', 'XII-', $kelasAsal->id_kelas);
        } elseif (str_starts_with($kelasAsal->id_kelas, 'XII-')) {
        
            continue;
        }

 
        $kelasTujuanData = Kelas::where('id_kelas', $kelasTujuan)->first();

        if ($kelasTujuanData) {
            Siswa::where('id_kelas', $kelasAsal->id_kelas)
                ->update(['id_kelas' => $kelasTujuanData->id_kelas]);
        }
    }

    return back()->with('success', 'Semua siswa berhasil dinaikkan kelas');
}

    public function skoringPenghargaan(Request $request)
{
   
     $request->validate([
            
            'nis'               => 'required',
            'id_aspekpenilaian' => 'required',
        ]);

        // Ambil skor & uraian dari aspek_penilaian
        $aspek  = aspek_penilaian::findOrFail($request->id_aspekpenilaian);
        $skor   = (int) $aspek->indikator_poin;
        $uraian = $aspek->uraian;
        $user   = Auth::user();

        // Simpan penilaian
        penilaian::create([
            
            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,
            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' =>  null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'created_at'        => now(),
        ]);

        // Update poin siswa
        $siswa = siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $siswa->poin_apresiasi += $skor;
            $siswa->poin_total     += $skor;
            $siswa->save();

            // Simpan log aktivitas (pakai query builder agar kategori pasti tersimpan)
            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Apresiasi',
                'activity'    => 'Tambah Penghargaan',
                'description' => $uraian,   // uraian dari aspek_penilaian
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

       return redirect()->route('siswa.show', $request->nis)
    ->with('success', 'Data penghargaan berhasil ditambahkan.');
}


    public function skoringPelanggaran(Request $request)
{
   
     $request->validate([
            'nis'               => 'required',
            'id_aspekpenilaian' => 'required',
        ]);

        $user = Auth::user();
        $aspek   = aspek_penilaian::findOrFail($request->id_aspekpenilaian);
        $skor    = (int) $aspek->indikator_poin;
        $uraian  = $aspek->uraian;

        // Simpan penilaian
        penilaian::create([

            'nis'               => $request->nis,
            'id_aspekpenilaian' => $request->id_aspekpenilaian,

            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'created_at'        => now(),

        ]);

        // Update poin siswa
        $siswa = siswa::where('nis', $request->nis)->first();
        $user = Auth::user();
        if ($siswa) {
            $siswa->poin_pelanggaran += $skor;
            $siswa->poin_total       -= $skor;
            $siswa->save();

            // Insert ke activity_logs
            DB::table('activity_logs')->insert([
                'user_id'     => $user->id,
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Tambah Pelanggaran',
                'description' => $uraian, // gunakan uraian aspek_penilaian
                'point'       => $skor,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('siswa.show', $request->nis)
          ->with('success', 'Data Pelanggaran berhasil ditambahkan.');
}
    public function createPenanganan(Request $request, $nis)
{
    $request->validate([
            'nis' => 'required',
            'nama_intervensi' => 'required|string|max:255',
            'isi_intervensi' => 'required|string|max:1000',
            'tanggal_Mulai_Perbaikan' => 'required|date',
            'tanggal_Selesai_Perbaikan' => 'required|date|after_or_equal:tanggal_Mulai_Perbaikan',
            'status' => 'required|string|max:50',

        ]);
        $user = Auth::user();
        intervensi::create([
            'nis' => $request->nis,
            'nip_bk'=> $user->gurubk->nip_bk ?? null,
            'nip_walikelas'=> $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek'=> $user->wakasek->nip_wakasek ?? null,
            'nama_intervensi' => $request->nama_intervensi,
            'isi_intervensi' => $request->isi_intervensi,
            'tanggal_Mulai_Perbaikan' => $request->tanggal_Mulai_Perbaikan,
            'tanggal_Selesai_Perbaikan' => $request->tanggal_Selesai_Perbaikan,
            'status' => $request->status,
            'created_at' => now(),
        ]);

         return redirect()->route('siswa.show', $request->nis)
          ->with('success', 'Data Penanganan berhasil ditambahkan.');

    }


}
