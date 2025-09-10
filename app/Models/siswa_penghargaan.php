<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa_penghargaan extends Model
{
    protected $table = 'siswapenghargaan';
    protected $fillable = [
        'id',
        'nis',
        'id_penghargaan',
        'created_at',
        'updated_at',
    ];

    public function penghargaan()
    {
        return $this->belongsTo(penghargaan::class, 'id_penghargaan', 'id_penghargaan');
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nis', 'nis');
    }
}
