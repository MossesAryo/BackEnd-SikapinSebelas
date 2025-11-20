<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class intervensi extends Model
{
    protected $table = 'intervensi';
    protected $primaryKey = 'id_intervensi';
    public $incrementing = true;             
    protected $keyType = 'int';
    protected $guarded = ['id_intervensi'];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nis', 'nis');
    }

    public function guruBk()
    {
        return $this->belongsTo(guru_bk::class, 'nip_bk', 'nip_bk');
    }
}
