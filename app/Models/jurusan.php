<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = ['id_jurusan', 'nama_jurusan'];
    public $timestamps = false;
    protected $keyType = 'string';
}
