<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruBkKelas extends Model
{
    protected $table = 'guru_bk_kelas';
    protected $fillable = ['guru_bk_id', 'kelas_id'];

    public function guruBk()
    {
        return $this->belongsTo(guru_bk::class, 'guru_bk_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
