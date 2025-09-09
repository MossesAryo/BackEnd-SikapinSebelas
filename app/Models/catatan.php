<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catatan extends Model
{
    protected $table = 'catatan';
    protected $fillable = ['nis', 'isi_catatan', 'nip_wakasek', 'nip_walikelas', 'judul_catatan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
