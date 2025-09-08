<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa_sp extends Model
{
   protected $table = 'siswaperingatan';
    protected $fillable = [
        'id',
        'nis',
        'id_sp',
        'created_at',
        'updated_at',
    ];

    public function peringatan()
    {
        return $this->belongsTo(User::class, 'id_sp', 'id_sp');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
