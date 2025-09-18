<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['id_kelas', 'nama_kelas', 'jurusan'];
    public $timestamps = false;
    protected $keyType = 'string';

    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_kelas', 'id_kelas');
    }
    public function walikelas()
    {
        return $this->hasOne(walikelas::class, 'id_kelas', 'id_kelas');
    }


   
}
