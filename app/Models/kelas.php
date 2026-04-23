<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model kelas/rombel.
 * Data kelas beserta jurusan, wali, guru BK, dan relasi siswa.
 */
class kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['id_kelas', 'nama_kelas', 'id_jurusan'];
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
