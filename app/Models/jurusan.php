<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
       public $incrementing = false;  // ← tambah ini
    protected $keyType = 'string';
    protected $fillable = ['id_jurusan', 'nama_jurusan'];
    

    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_jurusan', 'id_jurusan');
    }
    public function ketuaProgram()
    {
        return $this->hasOne(ketuaProgram::class, 'id_jurusan', 'id_jurusan');
    }
    public function kelas()
    {
        return $this->hasMany(kelas::class, 'id_jurusan', 'id_jurusan');
    }

}
