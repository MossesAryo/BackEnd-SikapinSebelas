<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model tahun ajaran.
 * Menyimpan periode akademik aktif dengan tanggal mulai/akhir.
 */
class tahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tahun_ajaran',
        'status',
    ];

    
}
