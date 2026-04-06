<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru_bk extends Model
{
    protected $table = 'guru_bk';
    protected $fillable = ['nip_bk', 'username', 'nama_guru_bk'];
    protected $primaryKey = 'nip_bk';
    protected $keyType = 'int';
    public $incrementing = false; 


    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
   public function kelas()
{
    return $this->belongsToMany(
        kelas::class,
        'guru_bk_kelas',
        'guru_bk_id',    
        'kelas_id',       
        'nip_bk',       
        'id_kelas'         
    );
}
}
