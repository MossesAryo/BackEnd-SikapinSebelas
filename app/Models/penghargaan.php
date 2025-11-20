<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penghargaan extends Model
{
    protected $table = 'penghargaan';
    protected $primaryKey = 'id_penghargaan';
    public $timestamps = false;
    protected $fillable = [
        'id_penghargaan',
        'tanggal_penghargaan',
        'level_penghargaan',
        'alasan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
