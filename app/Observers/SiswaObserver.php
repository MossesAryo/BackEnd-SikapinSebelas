<?php

namespace App\Observers;

use App\Models\siswa;
use App\Models\siswa_penghargaan;
use App\Models\siswa_sp;
use App\Models\penghargaan;
use App\Models\surat_peringatan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth; // Tambahkan ini di atas

class SiswaObserver
{
    public function updated(siswa $siswa)
    {
        if ($siswa->isDirty('poin_apresiasi') || $siswa->isDirty('poin_total')) {
            $this->cekPenghargaanOtomatis($siswa);
            $this->cekSPOtomatis($siswa);
        }
    }

    private function cekPenghargaanOtomatis($siswa)
    {
        // Gunakan poin_total untuk menentukan PH. Jika poin_total <= -25 maka SP menang.
        $poinTotal = $siswa->poin_total ?? 0;

        if ($poinTotal <= -25) {
            // hapus semua penghargaan yang terkait siswa ini (hanya relasi)
            siswa_penghargaan::where('nis', $siswa->nis)->delete();
            return;
        }

        // Tentukan level PH tertinggi yang sesuai berdasarkan poin_total
        $level = null;
        if ($poinTotal >= 151) {
            $level = 'PH3';
        } elseif ($poinTotal >= 126) {
            $level = 'PH2';
        } elseif ($poinTotal >= 100) {
            $level = 'PH1';
        }

        if ($level) {
            $penghargaan = penghargaan::firstOrCreate(
                ['level_penghargaan' => $level],
                [
                    'tanggal_penghargaan' => now(),
                    'alasan' => "Penghargaan otomatis – Poin total sesuai rentang",
                ]
            );

            // buat relasi untuk level yang sesuai jika belum ada
            if (!siswa_penghargaan::where('nis', $siswa->nis)->where('id_penghargaan', $penghargaan->id_penghargaan)->exists()) {
                siswa_penghargaan::create([
                    'nis' => $siswa->nis,
                    'id_penghargaan' => $penghargaan->id_penghargaan,
                ]);

                ActivityLog::create([
                    'user_id' => Auth::id() ?? 1,
                    'nis' => $siswa->nis,
                    'kategori' => 'Apresiasi',
                    'activity' => 'Penghargaan Otomatis',
                    'description' => "Mendapatkan {$level}",
                    'point' => 0,
                ]);
            }

            // hapus relasi penghargaan lain yang tidak sesuai level ini
            $otherPengh = siswa_penghargaan::where('nis', $siswa->nis)
                ->whereHas('penghargaan', fn($q) => $q->where('level_penghargaan', '!=', $level));
            if ($otherPengh->exists()) {
                $otherPengh->delete();
            }
        } else {
            // tidak memenuhi syarat PH -> hapus relasi apa pun
            siswa_penghargaan::where('nis', $siswa->nis)->delete();
        }
    }

    private function cekSPOtomatis($siswa)
    {
        $poinTotal = $siswa->poin_total ?? 0;

        // Tentukan level SP tertinggi jika memenuhi
        $level = null;
        if ($poinTotal <= -76) {
            $level = 'SP3';
        } elseif ($poinTotal <= -51) {
            $level = 'SP2';
        } elseif ($poinTotal <= -25) {
            $level = 'SP1';
        }

        if ($level) {
            // jika SP tercapai, hapus semua penghargaan relasi siswa
            siswa_penghargaan::where('nis', $siswa->nis)->delete();

            // buat SP yang sesuai dan pastikan hanya satu level SP tersisa
            $this->buatSP($siswa, $level, 'poin sesuai rentang');

            // hapus SP lain yang tidak sesuai level ini
            $otherSP = siswa_sp::where('nis', $siswa->nis)
                ->whereHas('peringatan', fn($q) => $q->where('level_sp', '!=', $level));
            if ($otherSP->exists()) {
                $otherSP->delete();
            }
        } else {
            // tidak memenuhi SP -> hapus relasi SP yang ada
            siswa_sp::where('nis', $siswa->nis)->delete();
        }
    }

    private function buatSP($siswa, $level, $keterangan)
    {
        $sp = surat_peringatan::firstOrCreate(
            ['level_sp' => $level],
            [
                'tanggal_sp' => now(),
                'alasan' => "Surat Peringatan otomatis – {$keterangan}",
            ]
        );
        // Jangan buat duplikat relasi siswa_sp jika sudah ada
        if (!siswa_sp::where('nis', $siswa->nis)->where('id_sp', $sp->id_sp)->exists()) {
            siswa_sp::create([
                'nis'   => $siswa->nis,
                'id_sp' => $sp->id_sp,
            ]);

            ActivityLog::create([
                'user_id'     => Auth::id() ?? 1,
                'nis'         => $siswa->nis,
                'kategori'    => 'Pelanggaran',
                'activity'    => 'Surat Peringatan Otomatis',
                'description' => "Mendapatkan {$level} ({$keterangan})",
                'point'       => 0,
            ]);
        }
    }
}