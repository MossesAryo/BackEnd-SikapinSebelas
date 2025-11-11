<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\jurusan;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    $query = Kelas::query();
    
    // Filter berdasarkan jurusan
    if ($request->has('jurusan') && !empty($request->jurusan)) {
        $query->whereIn('jurusan', $request->jurusan);
    }
    
    // Filter berdasarkan tingkat - PERBAIKAN UNTUK MENGHINDARI KONFLIK
    if ($request->has('tingkat') && !empty($request->tingkat)) {
        $query->where(function($q) use ($request) {
            foreach ($request->tingkat as $tingkat) {
                switch ($tingkat) {
                    case 'X':
                        // Hanya kelas X (tidak termasuk XI atau XII)
                        $q->orWhere('nama_kelas', 'REGEXP', '^X [A-Z]+');
                        break;
                    case 'XI':
                        // Hanya kelas XI
                        $q->orWhere('nama_kelas', 'LIKE', 'XI %');
                        break;
                    case 'XII':
                        // Hanya kelas XII
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
        // Default sorting jika tidak ada yang dipilih
        $query->orderByRaw("CASE 
            WHEN nama_kelas LIKE 'X %' THEN 1 
            WHEN nama_kelas LIKE 'XI %' THEN 2 
            WHEN nama_kelas LIKE 'XII %' THEN 3 
            ELSE 4 END")
        ->orderBy('jurusan', 'asc')
        ->orderBy('nama_kelas', 'asc');
    }
    
    $kelas = $query->paginate(10)->appends($request->all());
    return view('wakasek.kelas.kelas', compact('kelas'));
}

    public function jurusanwakasek()
    {
        $kelas = kelas::all();

        return view('wakasek.siswa.jurusan', compact('kelas'));
    }
    public function kelaswakasek()
    {
        $kelas = kelas::all();

        return view('wakasek.siswa.kelas', compact('kelas'));
    }

    public function jurusanbk()
    {
        $kelas = kelas::all();

        return view('gurubk.siswa.jurusan', compact('kelas'));
    }
    public function kelasbk()
    {
        $kelas = kelas::all();

        return view('gurubk.siswa.kelas', compact('kelas'));
    }








    public function FetchApi()
    {
         $kelas = kelas::all();

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
