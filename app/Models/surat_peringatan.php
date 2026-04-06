<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model master surat peringatan.
 * Menyimpan template/jenis SP beserta poin yang melekat.
 */
class surat_peringatan extends Model
{
    protected $table = 'surat_peringatan';
    protected $primaryKey = 'id_sp';
    public $incrementing = true; 
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'id_sp',
        'tanggal_sp',
        'level_sp',
        'alasan',
    ];

    
}
