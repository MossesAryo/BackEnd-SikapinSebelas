<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['id_kelas', 'nama_kelas'];
    public $timestamps = false;
    public $incrementing = false; 

    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_kelas', 'id_kelas');
    }
    public function walikelas()
    {
        return $this->hasOne(walikelas::class, 'id_kelas', 'id_kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan', 'id_jurusan');
    }
   public function guruBk()
{
    return $this->belongsToMany(
        guru_bk::class,
        'guru_bk_kelas',   
        'kelas_id',        
        'guru_bk_id',    
        'id_kelas',        
        'nip_bk'  
    );         
}


   
}
