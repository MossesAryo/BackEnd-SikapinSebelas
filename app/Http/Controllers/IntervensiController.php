<?php

namespace App\Http\Controllers;

use App\Exports\Intervensi_ExportExcel;
use App\Models\aspek_penilaian;
use App\Models\catatan;
use App\Models\intervensi;
use App\Models\kelas;
use App\Models\ketua_program;
use App\Models\siswa;   // TAMBAHAN INI WAJIB!
use App\Models\walikelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Penanganan intervensi siswa.
 * Catat rencana, tindak lanjut, dan status intervensi.
 */
class IntervensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $kelas = kelas::all();
        $catatan = catatan::all();
        $selectedKelas = null;
        $selectedJurusan = null;

        // Filter siswa untuk dropdown (create modal)
        $siswaList = siswa::where('poin_pelanggaran', '>', 0);
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
            $query->whereHas('siswa', fn ($q) => $q->where('id_kelas', $kelasWalikelas));
        }
        if ($user->role == 4 && $selectedJurusan) {
            $query->whereHas('siswa', fn ($q) => $q->whereHas('kelas', fn ($k) => $k->where('jurusan', $selectedJurusan)));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                    ->orWhere('nama_siswa', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kelas')) {
            $query->whereHas('siswa', fn ($q) => $q->where('id_kelas', $request->kelas));
        }

        if ($request->filled('jurusan')) {
            $jur = $request->jurusan;
            $query->whereHas('siswa', fn ($q) => $q->whereHas('kelas', fn ($q2) => $q2->where('jurusan', $jur)));
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
            'nip_bk' => $user->gurubk->nip_bk ?? null,
            'nip_walikelas' => $user->walikelas->nip_walikelas ?? null,
            'nip_wakasek' => $user->wakasek->nip_wakasek ?? null,
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
        $kelas = kelas::all();
        $siswa = siswa::all();
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
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function exportPdf(Request $request)
    {
        $query = intervensi::with(['siswa.kelas']);
        $user = Auth::user();

        if ($user && $user->role == 3) {
            $walikelas = walikelas::where('username', $user->username)->first();
            if ($walikelas && $walikelas->id_kelas) {
                $request->merge(['kelas' => $walikelas->id_kelas]);
                $request->request->remove('jurusan');
            }
        } elseif ($user && $user->role == 4) {
            $ketua = ketua_program::where('username', $user->username)->first();
            if ($ketua && $ketua->jurusan) {
                $request->merge(['jurusan' => $ketua->jurusan]);
                $request->request->remove('kelas');
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
            $query->whereHas('siswa', fn ($q) => $q->where('id_kelas', $request->kelas));
        }

        if ($request->filled('jurusan')) {
            $jur = $request->jurusan;
            $query->whereHas('siswa', fn ($q) => $q->whereHas('kelas.jurusan', fn ($q2) => $q2->where('id_jurusan', $jur))
            );
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
        $user = Auth::user();

        if ($user && $user->role == 3) {
            $walikelas = walikelas::where('username', $user->username)->first();
            if ($walikelas && $walikelas->id_kelas) {
                $request->merge(['kelas' => $walikelas->id_kelas]);
                $request->request->remove('jurusan');
            }
        } elseif ($user && $user->role == 4) {
            $ketua = ketua_program::where('username', $user->username)->first();
            if ($ketua && $ketua->jurusan) {
                $request->merge(['jurusan' => $ketua->jurusan]);
                $request->request->remove('kelas');
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
            $query->whereHas('siswa', fn ($q) => $q->where('id_kelas', $request->kelas));
        }

        if ($request->filled('jurusan')) {
            $jur = $request->jurusan;
            $query->whereHas('siswa', fn ($q) => $q->whereHas('kelas.jurusan', fn ($q2) => $q2->where('id_jurusan', $jur))
            );
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
   public function AddPenangananAPI(Request $request, string $nis)
{
    // ── 1. Validate input ─────────────────────────────────────────────────
    $validator = \Illuminate\Support\Facades\Validator::make(
        array_merge($request->all(), ['nis' => $nis]),
        [
            'nis'                        => 'required|exists:siswa,nis',
            'nama_intervensi'            => 'required|string|max:255',
            'isi_intervensi'             => 'required|string|max:1000',
            'status'                     => 'required|in:Binaan Khusus,Dalam Binaan,Selesai',
            'tanggal_Mulai_Perbaikan'    => 'required|date',
            'tanggal_Selesai_Perbaikan'  => 'required|date|after_or_equal:tanggal_Mulai_Perbaikan',
        ],
        [
            'nis.exists'                          => 'Siswa tidak ditemukan.',
            'nama_intervensi.required'            => 'Nama penanganan wajib diisi.',
            'isi_intervensi.required'             => 'Isi penanganan wajib diisi.',
            'status.in'                           => 'Status tidak valid.',
            'tanggal_Mulai_Perbaikan.required'    => 'Tanggal mulai wajib diisi.',
            'tanggal_Selesai_Perbaikan.required'  => 'Tanggal selesai wajib diisi.',
            'tanggal_Selesai_Perbaikan.after_or_equal' =>
                'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ]
    );
 
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
            'errors'  => $validator->errors(),
        ], 422);
    }
 
    // ── 2. Resolve caller identity from query params ───────────────────────
    $nip      = $request->query('nip', '');
    $idKelas  = $request->query('id_kelas', '');
 
    // Determine which role this NIP belongs to and set the appropriate FK
    $nipBk         = null;
    $nipWalikelas  = null;
    $nipWakasek    = null;
 
    $walikelas = \App\Models\walikelas::where('nip_walikelas', $nip)->first();
    if ($walikelas) {
        $nipWalikelas = $walikelas->nip_walikelas;
    } else {
        // Try BK
        $gurubk = \App\Models\gurubk::where('nip_bk', $nip)->first();
        if ($gurubk) {
            $nipBk = $gurubk->nip_bk;
        }
    }
 
    // ── 3. Optional: verify the student belongs to the given class ─────────
    if (!empty($idKelas)) {
        $siswa = \App\Models\siswa::where('nis', $nis)->first();
        if ($siswa && $siswa->id_kelas !== $idKelas) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak berada di kelas Anda.',
            ], 403);
        }
    }
 
    // ── 4. Create the intervensi record ────────────────────────────────────
    try {
        $intervensi = \App\Models\intervensi::create([
            'nis'                       => $nis,
            'nip_bk'                    => $nipBk,
            'nip_walikelas'             => $nipWalikelas,
            'nip_wakasek'               => $nipWakasek,
            'nama_intervensi'           => $request->nama_intervensi,
            'isi_intervensi'            => $request->isi_intervensi,
            'status'                    => $request->status,
            'tanggal_Mulai_Perbaikan'   => $request->tanggal_Mulai_Perbaikan,
            'tanggal_Selesai_Perbaikan' => $request->tanggal_Selesai_Perbaikan,
            'created_at'                => now(),
        ]);
 
        return response()->json([
            'success' => true,
            'message' => 'Penanganan berhasil ditambahkan.',
            'data'    => [
                'id_intervensi'              => $intervensi->id_intervensi,
                'nis'                        => $intervensi->nis,
                'nama_intervensi'            => $intervensi->nama_intervensi,
                'isi_intervensi'             => $intervensi->isi_intervensi,
                'status'                     => $intervensi->status,
                'tanggal_Mulai_Perbaikan'    => $intervensi->tanggal_Mulai_Perbaikan,
                'tanggal_Selesai_Perbaikan'  => $intervensi->tanggal_Selesai_Perbaikan,
                'created_at'                 => $intervensi->created_at,
            ],
        ], 201);
 
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
        ], 500);
    }
}
}
