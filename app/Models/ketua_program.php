<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ketua_program extends Model
{
    protected $table = 'ketua_program';
    protected $primaryKey = 'nip_kaprog';
    public $timestamps = false;

    protected $fillable = [
        'nip_kaprog',
        'id_user',
        'nama_ketua_program',
        'jurusan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
