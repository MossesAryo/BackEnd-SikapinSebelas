<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penghargaan extends Model
{
    protected $table = 'penghargaan';
    protected $primaryKey = 'id_penghargaan';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;
    protected $fillable = [
        'id_penghargaan',
        'tanggal_penghargaan',
        'level_penghargaan',
        'alasan',
    ];

}
