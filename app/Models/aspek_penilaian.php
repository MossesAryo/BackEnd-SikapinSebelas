<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aspek_penilaian extends Model
{
    protected $table = 'aspek_penilaian';
    protected $fillable = ['id_aspekpenilaian', 'jenis_poin', 'indikator_poin', 'uraian'];

 
}
