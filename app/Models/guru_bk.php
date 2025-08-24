<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru_bk extends Model
{
    protected $table = 'guru_bk';
    protected $fillable = ['nip_bk', 'username', 'nama_guru_bk'];
    protected $primaryKey = 'nip_bk';


    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
