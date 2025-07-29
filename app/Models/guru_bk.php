<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru_bk extends Model
{
    protected $table = 'guru_bk';
    protected $fillable = ['nip_bk', 'id_user', 'nama_guru_bk'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
