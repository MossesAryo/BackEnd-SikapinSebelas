<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\ketua_program;
use Illuminate\Support\Facades\Auth;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();
        
        // Filter berdasarkan role user yang login
        $user = Auth::user();
        
        if ($user) {
            // Jika user memiliki role ketua_program dan memiliki jurusan, filter berdasarkan jurusannya
            if ($user->role === 'ketua_program' && $user->jurusan) {
                $query->where('jurusan', $user->jurusan);
            }
            // Untuk wakasek dan guru_bk, tampilkan semua data (tidak difilter)
            // else if ($user->role === 'wakasek' || $user->role === 'guru_bk') {
            //     // Tidak ada filter, tampilkan semua
            // }
        }
        
        // Filter berdasarkan jurusan (untuk admin/wakasek) - manual filter
        if ($request->has('jurusan') && !empty($request->jurusan)) {
            $query->whereIn('jurusan', $request->jurusan);
        }
        
        // Filter berdasarkan tingkat
        if ($request->has('tingkat') && !empty($request->tingkat)) {
            $query->where(function($q) use ($request) {
                foreach ($request->tingkat as $tingkat) {
                    switch ($tingkat) {
                        case 'X':
                            $q->orWhere('nama_kelas', 'REGEXP', '^X [A-Z]+');
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
        
        // Pengurutan
        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {
                case 'nama_kelas_asc':
                    $query->orderBy('nama_kelas', 'asc');
                    break;
                case 'nama_kelas_desc':
                    $query->orderBy('nama_kelas', 'desc');
                    break;
                case 'jurusan_asc':
                    $query->orderBy('jurusan', 'asc');
                    break;
                case 'jurusan_desc':
                    $query->orderBy('jurusan', 'desc');
                    break;
                case 'tingkat_asc':
                    $query->orderByRaw("CASE 
                        WHEN nama_kelas LIKE 'X %' THEN 1 
                        WHEN nama_kelas LIKE 'XI %' THEN 2 
                        WHEN nama_kelas LIKE 'XII %' THEN 3 
                        ELSE 4 END")
                    ->orderBy('jurusan', 'asc')
                    ->orderBy('nama_kelas', 'asc');
                    break;
                case 'tingkat_desc':
                    $query->orderByRaw("CASE 
                        WHEN nama_kelas LIKE 'XII %' THEN 1 
                        WHEN nama_kelas LIKE 'XI %' THEN 2 
                        WHEN nama_kelas LIKE 'X %' THEN 3 
                        ELSE 4 END")
                    ->orderBy('jurusan', 'asc')
                    ->orderBy('nama_kelas', 'asc');
                    break;
            }
        } else {
            // Default sorting
            $query->orderByRaw("CASE 
                WHEN nama_kelas LIKE 'X %' THEN 1 
                WHEN nama_kelas LIKE 'XI %' THEN 2 
                WHEN nama_kelas LIKE 'XII %' THEN 3 
                ELSE 4 END")
            ->orderBy('jurusan', 'asc')
            ->orderBy('nama_kelas', 'asc');
        }
        
        
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_kelas', 'like', '%' . $search . '%')
              ->orWhere('id_kelas', 'like', '%' . $search . '%');
        });
    }

        // Paginate — sertakan semua query params yang relevan supaya pagination mempertahankan filter/search
    $kelas = $query->orderBy('nama_kelas')->paginate(10)
                  ->appends($request->only(['search', 'jurusan', 'kelas']));
        
        // Return view berdasarkan role user
        if ($user) {
            switch ($user->role) {
                case 'wakasek':
                    return view('wakasek.kelas.kelas', compact('kelas'));
                case 'guru_bk':
                    return view('gurubk.kelas', compact('kelas'));
                default:
                    return view('wakasek.kelas.kelas', compact('kelas'));
            }
        }
        
        return view('wakasek.kelas.kelas', compact('kelas'));
    }

    // Method untuk ketua program
public function kelasKetuaProgram(Request $request)
{
    $user = Auth::user();

    // Ambil data ketua program
    $ketua = ketua_program::where('username', $user->username)->first();
    if (!$ketua) abort(403, "Data Ketua Program tidak ditemukan.");

    $jurusanKetua = $ketua->jurusan;

    // Query utama: selalu filter jurusan ketua program
    $query = Kelas::where('jurusan', $jurusanKetua);


    if ($request->filled('tingkat')) {
        $query->where(function($q) use ($request) {
            foreach ($request->tingkat as $tingkat) {
                switch ($tingkat) {
                    case 'X':
                        $q->orWhere('nama_kelas', 'REGEXP', '^X [A-Z]+');
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
        // default sorting
        $query->orderByRaw("CASE 
            WHEN nama_kelas LIKE 'X %' THEN 1 
            WHEN nama_kelas LIKE 'XI %' THEN 2 
            WHEN nama_kelas LIKE 'XII %' THEN 3 
            ELSE 4 END")
        ->orderBy('nama_kelas', 'asc');
    }

    // ============================
    // PAGINATION
    // ============================
    $kelas = $query->paginate(10)->appends($request->all());

    return view('ketua_program.kelas.kelas', compact('kelas'));
}



    // Method lainnya...
    public function jurusanwakasek()
    {
        $user = Auth::user();
        $query = Kelas::query();
        
        if ($user && $user->role === 'ketua_program' && $user->jurusan) {
            $query->where('jurusan', $user->jurusan);
        }
        
        $kelas = $query->get();
        return view('wakasek.siswa.jurusan', compact('kelas'));
    }

    public function kelaswakasek()
    {
        $user = Auth::user();
        $query = Kelas::query();
        
        if ($user && $user->role === 'ketua_program' && $user->jurusan) {
            $query->where('jurusan', $user->jurusan);
        }
        
        $kelas = $query->get();
        return view('wakasek.siswa.kelas', compact('kelas'));
    }

    public function jurusanbk()
    {
        $kelas = Kelas::all();
        return view('gurubk.siswa.jurusan', compact('kelas'));
    }

    public function kelasbk()
    {
        $kelas = Kelas::all();
        return view('gurubk.siswa.kelas', compact('kelas'));
    }



    public function kelasketuaaprogram()
    {
        $user = Auth::user();
        $query = Kelas::query();
        
        if ($user && $user->role === 'ketua_program' && $user->jurusan) {
            $query->where('jurusan', $user->jurusan);
        }
        
        $kelas = $query->get();
        return view('ketua_program.kelas', compact('kelas'));
    }

    public function FetchApi()
    {
        $user = Auth::user();
        $query = Kelas::query();
        
        if ($user && $user->role === 'ketua_program' && $user->jurusan) {
            $query->where('jurusan', $user->jurusan);
        }
        
        $kelas = $query->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Data kelas berhasil diambil',
            'data'    => $kelas
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
        ]);

        kelas::create($request->all());
        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_kelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
        ]);

        kelas::where('id_kelas', $id)->update($data);
        return redirect()->route('kelas')->with('success', 'kelas berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = kelas::where('id_kelas', $id)->delete();
        return redirect()->route('kelas')->with('success', 'kelas berhasil dihapus');
    }
}