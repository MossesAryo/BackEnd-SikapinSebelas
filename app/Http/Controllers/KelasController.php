<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\jurusan;
use App\Models\guru_bk;
use App\Models\walikelas;
use Illuminate\Http\Request;
use App\Models\ketua_program;
use Illuminate\Support\Facades\Auth;

/**
 * Manajemen data kelas beserta jurusan.
 * CRUD kelas, impor/ekspor, dan relasi wali atau guru BK.
 */
class KelasController extends Controller
{
    public function index(Request $request)
    {
        $user        = Auth::user();
        $jurusanList = jurusan::all();
        $query       = kelas::with('jurusan');

        if ($user) {

            // === Role 4: Ketua Program — hanya kelas dari jurusannya ===
            if ($user->role == '4') {
                $ketua = ketua_program::where('username', $user->username)->first();

                if (!$ketua) {
                    abort(403, 'Data Ketua Program tidak ditemukan');
                }

                $query->where('id_jurusan', $ketua->id_jurusan);
            }

            // === Role 2: Guru BK — hanya kelas yang dipegang ===
            if ($user->role == '2') {
                $guru = guru_bk::where('username', $user->username)->first();

                if ($guru) {
                    $kelasIds = $guru->kelas()->pluck('kelas.id_kelas')->toArray();
                    $query->whereIn('id_kelas', $kelasIds);
                }
            }

            // === Role 3: Walikelas — hanya kelas yang dipegang ===
            if ($user->role == '3') {
                $wali = walikelas::where('username', $user->username)->first();

                if (!$wali) {
                    abort(403, 'Data Walikelas tidak ditemukan');
                }

                $query->where('id_kelas', $wali->id_kelas);
            }
        }

        // Filter jurusan (skip untuk role 4 karena sudah di-filter otomatis)
        if ($request->filled('jurusan') && (!$user || $user->role != '4')) {
            $query->whereIn('id_jurusan', $request->jurusan);
        }

        if ($request->filled('tingkat')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->tingkat as $tingkat) {
                    switch ($tingkat) {
                        case 'X':
                            $q->orWhere('nama_kelas', 'REGEXP', '^X ');
                            break;
                        case 'XI':
                            $q->orWhere('nama_kelas', 'LIKE', 'XI %');
                            break;
                        case 'XII':
                            $q->orWhere('nama_kelas', 'LIKE', 'XII %');
                            break;
                    }
                }
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_kelas', 'like', "%$search%")
                  ->orWhere('id_kelas', 'like', "%$search%")
                  ->orWhereHas('jurusan', function ($q) use ($search) {
                      $q->where('nama_jurusan', 'like', "%$search%");
                  });
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'nama_kelas_asc':
                    $query->orderBy('nama_kelas', 'asc');
                    break;
                case 'nama_kelas_desc':
                    $query->orderBy('nama_kelas', 'desc');
                    break;
                case 'tingkat_asc':
                    $query->orderByRaw("CASE
                        WHEN nama_kelas LIKE 'X %' THEN 1
                        WHEN nama_kelas LIKE 'XI %' THEN 2
                        WHEN nama_kelas LIKE 'XII %' THEN 3
                        ELSE 4 END")
                        ->orderBy('nama_kelas', 'asc');
                    break;
                case 'tingkat_desc':
                    $query->orderByRaw("CASE
                        WHEN nama_kelas LIKE 'XII %' THEN 1
                        WHEN nama_kelas LIKE 'XI %' THEN 2
                        WHEN nama_kelas LIKE 'X %' THEN 3
                        ELSE 4 END")
                        ->orderBy('nama_kelas', 'asc');
                    break;
            }
        } else {
            $query->orderByRaw("CASE
                WHEN nama_kelas LIKE 'X %' THEN 1
                WHEN nama_kelas LIKE 'XI %' THEN 2
                WHEN nama_kelas LIKE 'XII %' THEN 3
                ELSE 4 END")
                ->orderBy('nama_kelas', 'asc');
        }

        $kelas = $query->paginate(10)->appends($request->all());

        return view('wakasek.kelas.kelas', compact('kelas', 'jurusanList'));
    }

    public function FetchApi()
    {
        $user  = Auth::user();
        $query = kelas::with('jurusan');

        if ($user) {

            // === Role 4: Ketua Program ===
            if ($user->role == '4') {
                $ketua = ketua_program::where('username', $user->username)->first();
                if ($ketua) {
                    $query->where('id_jurusan', $ketua->id_jurusan);
                }
            }

            // === Role 2: Guru BK ===
            if ($user->role == '2') {
                $guru = guru_bk::where('username', $user->username)->first();
                if ($guru) {
                    $kelasIds = $guru->kelas()->pluck('kelas.id_kelas')->toArray();
                    $query->whereIn('id_kelas', $kelasIds);
                }
            }

            // === Role 3: Walikelas ===
            if ($user->role == '3') {
                $wali = walikelas::where('username', $user->username)->first();
                if ($wali) {
                    $query->where('id_kelas', $wali->id_kelas);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data kelas berhasil diambil',
            'data'    => $query->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'id_kelas'   => 'required',
            'nama_kelas' => 'required',
            'id_jurusan' => 'required',
        ]);

        kelas::create($request->all());

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
        $data = $request->validate([
            'id_kelas'   => 'required',
            'nama_kelas' => 'required',
            'id_jurusan' => 'required',
        ]);

        kelas::where('id_kelas', $id)->update($data);

        return redirect()->route('kelas')->with('success', 'Kelas berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
        kelas::where('id_kelas', $id)->delete();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
