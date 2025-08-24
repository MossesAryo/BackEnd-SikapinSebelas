<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aspek_penilaian extends Model
{
    public $incrementing = false; // jangan auto increment
    protected $keyType = 'string'; // tipe primary key string
    protected $table = 'aspek_penilaian';
    protected $primaryKey = 'id_aspekpenilaian';
    protected $fillable = ['id_aspekpenilaian', 'kode', 'jenis_poin', 'kategori', 'uraian', 'pelanggaran_ke','indikator_poin'];


}
