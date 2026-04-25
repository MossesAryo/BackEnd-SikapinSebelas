<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model intervensi siswa.
 * Mencatat rencana dan tindak lanjut intervensi setiap siswa.
 */
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
    public function walikelas()
    {
        return $this->belongsTo(walikelas::class, 'nip_walikelas', 'nip_walikelas');
    }
    public function wakasek()
    {
        return $this->belongsTo(wakasek::class, 'nip_wakasek', 'nip_wakasek');
    }
    public function bukti()
    {
        return $this->hasMany(bukti_pembinaan::class, 'intervensi_id', 'id_intervensi');
    }
}
