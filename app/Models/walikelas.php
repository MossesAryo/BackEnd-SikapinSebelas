<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class walikelas extends Model
{
    protected $table = 'walikelas';
    protected $fillable = ['nip_walikelas', 'id', 'id_kelas', 'nama_walikelas'];
    
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }

  
}
