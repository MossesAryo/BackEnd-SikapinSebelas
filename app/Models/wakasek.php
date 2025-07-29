<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wakasek extends Model
{
    protected $table = 'wakasek';
    protected $primaryKey = 'nip_wakasek';
    public $timestamps = false;

    protected $fillable = [
        'nip_wakasek',
        'id_user',
        'nama_wakasek',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user', 'id');
    }
}
