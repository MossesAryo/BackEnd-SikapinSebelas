<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class surat_peringatan extends Model
{
    protected $table = 'surat_peringatan';
    protected $primaryKey = 'id_sp';
    public $timestamps = false;

    protected $fillable = [
        'id_sp',
        'nis',
        'tanggal_sp',
        'level_sp',
        'alasan',
    ];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nis', 'nis');
    }
}
