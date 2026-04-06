<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model log aktivitas pengguna.
 * Menyimpan jejak aksi (user, siswa, keterangan) di sistem.
 */
class ActivityLog extends Model
{
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'nis', 'nis');
    }
}
