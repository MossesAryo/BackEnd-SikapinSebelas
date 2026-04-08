<?php

namespace App\Http\Controllers;

use App\Models\intervensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\walikelas;
use App\Models\ketua_program;
use App\Models\catatan;
use App\Models\aspek_penilaian;   // TAMBAHAN INI WAJIB!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\Intervensi_ExportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Penanganan intervensi siswa.
 * Catat rencana, tindak lanjut, dan status intervensi.
 */
class IntervensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $kelas   = kelas::all();
        $catatan = catatan::all();
        $selectedKelas = null;
        $selectedJurusan = null;

        // Filter siswa untuk dropdown (create modal)
        $siswaList = siswa::query();
        $kelasWalikelas = null;

        if ($user->role == 3) {
            $walikelas = walikelas::where('username', $user->username)->first();
            if ($walikelas && $walikelas->id_kelas) {
                $kelasWalikelas = $walikelas->id_kelas;
                $siswaList->where('id_kelas', $kelasWalikelas);
                $selectedKelas = $kelasWalikelas;
                $kelasEntity = kelas::where('id_kelas', $kelasWalikelas)->first();
                $selectedJurusan = $kelasEntity->jurusan ?? null;
                // batasi daftar kelas agar tidak membingungkan walikelas
                $kelas = kelas::where('id_kelas', $kelasWalikelas)->get();
            }
        } elseif ($user->role == 4) {
            // ketua program: jurusan otomatis
            $ketua = ketua_program::where('username', $user->username)->first();
            if ($ketua && $ketua->jurusan) {
                $selectedJurusan = $ketua->jurusan;
                $kelas = kelas::where('jurusan', $selectedJurusan)->get();
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

        if ($user->role == 3 && $kelasWalikelas) {
            $query->whereHas('siswa', fn($q) => $q->where('id_kelas', $kelasWalikelas));
        }
        if ($user->role == 4 && $selectedJurusan) {
            $query->whereHas('siswa', fn($q) => $q->whereHas('kelas', fn($k) => $k->where('jurusan', $selectedJurusan)));
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

        if ($request->filled('jurusan')) {
            $jur = $request->jurusan;
            $query->whereHas('siswa', fn($q) => $q->whereHas('kelas', fn($q2) => $q2->where('jurusan', $jur)));
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
            'aspekPel',   // JANGAN LUPA KIRIM KE VIEW!
            'selectedKelas',
            'selectedJurusan'
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
        try {
        $intervensi = intervensi::findOrFail($id_intervensi);
        $intervensi->delete();

        return back()->with('success', 'Data intervensi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportPdf(Request $request)
    {
        try {
            $query = intervensi::with(['siswa.kelas']);

            $user = Auth::user();
            // enforce role-based defaults
            if ($user && $user->role == 4) {
                $walikelas = walikelas::where('username', $user->username)->first();
                if ($walikelas && $walikelas->id_kelas) {
                    $request->merge(['kelas' => $walikelas->id_kelas]);
                }
            } elseif ($user && $user->role == 3) {
                $ketua = \App\Models\ketua_program::where('username', $user->username)->first();
                if ($ketua && $ketua->jurusan) {
                    $request->merge(['jurusan' => $ketua->jurusan]);
                }
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

            if ($request->filled('jurusan')) {
                $jur = $request->jurusan;
                $query->whereHas('siswa', fn($q) => $q->whereHas('kelas', fn($q2) => $q2->where('jurusan', $jur)));
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        try {
    $query = intervensi::with(['siswa.kelas']);

    $user = Auth::user();
    if ($user && $user->role == 4) {
        $walikelas = walikelas::where('username', $user->username)->first();
        if ($walikelas && $walikelas->id_kelas) {
            $request->merge(['kelas' => $walikelas->id_kelas]);
        }
    } elseif ($user && $user->role == 3) {
        $ketua = \App\Models\ketua_program::where('username', $user->username)->first();
        if ($ketua && $ketua->jurusan) {
            $request->merge(['jurusan' => $ketua->jurusan]);
        }
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

    if ($request->filled('jurusan')) {
        $jur = $request->jurusan;
        $query->whereHas('siswa', fn($q) => $q->whereHas('kelas', fn($q2) => $q2->where('jurusan', $jur)));
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
