<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nis',
        'id_kelas',
        'id_aspekpenilaian',
        'nama_siswa',
        'poin_apresiasi',
        'poin_pelanggaran',
        'poin_total'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }

    public function aspekPenilaian()
    {
        return $this->belongsTo(aspek_penilaian::class, 'id_aspekpenilaian', 'id_aspekpenilaian');
    }
}
