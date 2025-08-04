<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';       
    protected $fillable = [
        'nis',
        'id_kelas',
        'nama_siswa',
        'poin_apresiasi',
        'poin_pelanggaran',
        'poin_total'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }       
}
