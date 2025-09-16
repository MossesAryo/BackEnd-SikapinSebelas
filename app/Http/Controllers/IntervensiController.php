<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\catatan;


class IntervensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $intervensi = intervensi::all();
        $kelas = kelas::all();
        $siswa = siswa::all();
        $catatan = catatan::all();

        // Kirim data walikelas dan kelas ke view
        return view('gurubk.intervensi.index', compact('intervensi', 'kelas', 'siswa', 'catatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'nama_intervensi' => $request->nama_intervensi,
            'isi_intervensi' => $request->isi_intervensi,
            'tanggal_Mulai_Perbaikan' => $request->tanggal_Mulai_Perbaikan,
            'tanggal_Selesai_Perbaikan' => $request->tanggal_Selesai_Perbaikan,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        return redirect()->route('intervensi.index')->with('success', 'Data intervensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_intervensi)
    {
        $intervensi = Intervensi::with('siswa')
            ->where('id_intervensi', $id_intervensi)
            ->firstOrFail();
        $kelas = kelas::all();
        $siswa = siswa::all();
        $catatan = catatan::all();    

        return view('gurubk.intervensi.show', compact('intervensi', 'kelas', 'siswa', 'catatan'));
    }


    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_intervensi)
    {
        $request->validate([
            'nis' => 'required',
            'nama_intervensi' => 'required|string|max:255',
            'isi_intervensi' => 'required|string|max:1000',
            'tanggal_Mulai_Perbaikan' => 'required|date',
            'tanggal_Selesai_Perbaikan' => 'required|date|after_or_equal:tanggal_Mulai_Perbaikan',
            'perubahan_setelah_intervensi' => 'nullable|string|max:1000',
            'status' => 'required|string|max:50',
        ]);

        $intervensi = intervensi::where('id_intervensi', $id_intervensi)->firstOrFail();
        $intervensi->update([
            'nis' => $request->nis,
            'nama_intervensi' => $request->nama_intervensi,
            'isi_intervensi' => $request->isi_intervensi,
            'tanggal_Mulai_Perbaikan' => $request->tanggal_Mulai_Perbaikan,
            'tanggal_Selesai_Perbaikan' => $request->tanggal_Selesai_Perbaikan,
            'perubahan_setelah_intervensi' => $request->perubahan_setelah_intervensi,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Data intervensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_intervensi)
    {
        $intervensi = intervensi::findOrFail($id_intervensi);
        $intervensi->delete();

        return back()->with('success', 'Data intervensi berhasil dihapus.');
    }
}
