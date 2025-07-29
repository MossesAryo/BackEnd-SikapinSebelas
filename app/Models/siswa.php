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
        'point',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }       
}
