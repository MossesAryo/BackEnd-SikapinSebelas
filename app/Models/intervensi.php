<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class intervensi extends Model
{
    protected $table = 'intervensi';
    protected $fillable = ['id_intervensi', 'nis', 'nip_bk', 'nama_intervensi', 'status', 'tanggal'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function guruBk()
    {
        return $this->belongsTo(guru_bk::class, 'nip_bk', 'nip_bk');
    }

   
  
}
