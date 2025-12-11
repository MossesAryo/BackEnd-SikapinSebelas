<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\walikelas;
use App\Models\catatan;
use App\Models\aspek_penilaian;   // TAMBAHAN INI WAJIB!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\Intervensi_ExportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class IntervensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $kelas   = kelas::all();
        $catatan = catatan::all();

        // Filter siswa untuk dropdown (create modal)
        $siswaList = siswa::query();
        $kelasWalikelas = null;

        if ($user->role == 4) {
            $walikelas = walikelas::where('username', $user->username)->first();
            if ($walikelas && $walikelas->id_kelas) {
                $kelasWalikelas = $walikelas->id_kelas;
                $siswaList->where('id_kelas', $kelasWalikelas);
            }
        }
        $siswa = $siswaList->orderBy('nama_siswa')->get();

        // INI YANG SEBELUMNYA HILANG → PENYEBAB ERROR!
        $aspekPel = aspek_penilaian::whereIn('jenis_poin', ['Apresiasi', 'Pelanggaran'])
                    ->orderBy('jenis_poin')
                    ->orderBy('uraian')
                    ->get();

        // Query intervensi
        $query = intervensi::with(['siswa.kelas']);

        if ($user->role == 4 && $kelasWalikelas) {
            $query->whereHas('siswa', fn($q) => $q->where('id_kelas', $kelasWalikelas));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                  ->orWhere('nama_siswa', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kelas')) {
            $query->whereHas('siswa', fn($q) => $q->where('id_kelas', $request->kelas));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_Mulai_Perbaikan', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_Selesai_Perbaikan', '<=', $request->tanggal_akhir);
        }

        $intervensi = $query->latest()
                            ->paginate(10)
                            ->appends($request->all());

        return view('wakasek.intervensi.index', compact(
            'intervensi',
            'kelas',
            'siswa',
            'catatan',
            'aspekPel'   // JANGAN LUPA KIRIM KE VIEW!
        ));
    }

    // === METHOD LAIN TIDAK DIUBAH SAMA SEKALI ===
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
            'nip_bk'        => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek'   => $user->wakasek->nip_wakasek ?? null,
            'nama_intervensi' => $request->nama_intervensi,
            'isi_intervensi' => $request->isi_intervensi,
            'tanggal_Mulai_Perbaikan' => $request->tanggal_Mulai_Perbaikan,
            'tanggal_Selesai_Perbaikan' => $request->tanggal_Selesai_Perbaikan,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        return redirect()->route('intervensi.index')
            ->with('success', 'Data intervensi berhasil ditambahkan.');
    }

    public function show($id_intervensi)
    {
        $intervensi = intervensi::with('siswa')->findOrFail($id_intervensi);
        $kelas   = kelas::all();
        $siswa   = siswa::all();
        $catatan = catatan::all();

        return view('wakasek.intervensi.show', compact('intervensi', 'kelas', 'siswa', 'catatan'));
    }

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

        $intervensi = intervensi::findOrFail($id_intervensi);
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

        $returnTo = $request->input('return_to');
        if ($returnTo) {
            return redirect()->to($returnTo)->with('success', 'Data intervensi berhasil diperbarui.');
        }

        return redirect()->route('intervensi.index')->with('success', 'Data intervensi berhasil diperbarui.');
    }

    public function destroy(string $id_intervensi)
    {
        $intervensi = intervensi::findOrFail($id_intervensi);
        $intervensi->delete();

        return back()->with('success', 'Data intervensi berhasil dihapus.');
    }

          public function exportPdf(Request $request)
{
            $query = intervensi::with(['siswa.kelas']);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nis', 'like', "%{$search}%")
                      ->orWhere('nama_siswa', 'like', "%{$search}%");
                });
            }

            if ($request->filled('kelas')) {
                $query->whereHas('siswa', fn($q) => $q->where('id_kelas', $request->kelas));
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('tanggal_mulai')) {
                $query->whereDate('tanggal_Mulai_Perbaikan', '>=', $request->tanggal_mulai);
            }

            if ($request->filled('tanggal_akhir')) {
                $query->whereDate('tanggal_Selesai_Perbaikan', '<=', $request->tanggal_akhir);
            }

            $intervensi = $query->latest()->get();

            $pdf = Pdf::loadView('wakasek.intervensi.pdf', compact('intervensi'));
            return $pdf->download('Data_Intervensi.pdf');
}

   public function exportExcel(Request $request)
{
    $query = intervensi::with(['siswa.kelas']);

    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('siswa', function ($q) use ($search) {
            $q->where('nis', 'like', "%{$search}%")
              ->orWhere('nama_siswa', 'like', "%{$search}%");
        });
    }

    if ($request->filled('kelas')) {
        $query->whereHas('siswa', fn($q) => $q->where('id_kelas', $request->kelas));
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('tanggal_mulai')) {
        $query->whereDate('tanggal_Mulai_Perbaikan', '>=', $request->tanggal_mulai);
    }

    if ($request->filled('tanggal_akhir')) {
        $query->whereDate('tanggal_Selesai_Perbaikan', '<=', $request->tanggal_akhir);
    }

    $intervensi = $query->latest()->get();

    return Excel::download(new Intervensi_ExportExcel($intervensi), 'Data_Intervensi.xlsx');
}

}