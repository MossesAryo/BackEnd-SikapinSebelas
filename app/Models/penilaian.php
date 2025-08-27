<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    public $timestamps = false;

    protected $fillable = [
        'id_penilaian',
        'nip_wakasek',
        'nip_walikelas',
        'nip_bk',
        'id_aspekpenilaian',
        'nis',
        'created_at',
        
    ];

    public function wakasek()
    {
        return $this->belongsTo('App\Models\Wakasek', 'nip_wakasek');
    }
    public function walikelas()
    {
        return $this->belongsTo(Walikelas::class, 'nip_walikelas');
    }

    public function aspek_penilaian()
    {
        return $this->belongsTo(Aspek_Penilaian::class, 'id_aspekpenilaian', 'id_aspekpenilaian');
    }


    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function guruBk()
    {
        return $this->belongsTo(guru_bk::class, 'nip_bk', 'nip_bk');
    }

     public function aspekApresiasi()
    {
        return $this->belongsTo(Aspek_Penilaian::class, 'id_aspek_penilaian', 'id_aspek_penilaian')
                    ->where('jenis_poin', 'Apresiasi');
    }
    public function aspekPelanggaran()
    {
        return $this->belongsTo(Aspek_Penilaian::class, 'id_aspek_penilaian', 'id_aspek_penilaian')
                    ->where('jenis_poin', 'Pelanggaran');
    }
}
