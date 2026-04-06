<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ketua program.
 * Data ketua program dan jurusan yang diampu.
 */
class ketua_program extends Model
{
    protected $table = 'ketua_program';
    protected $primaryKey = 'nip_kaprog';
    public $timestamps = false;

    protected $fillable = [
        'nip_kaprog',
        'username',
        'nama_ketua_program',
        'id_jurusan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan', 'id_jurusan');
    }
   

}
