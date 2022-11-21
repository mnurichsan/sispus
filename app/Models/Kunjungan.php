<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $guarded = [];


    // public function dokter()
    // {
    //     return $this->hasOne(Dokter::class);
    // }
    
    // public function pasien()
    // {
    //     return $this->hasOne(Pasien::class);
    // }

    // public function poli()
    // {
    //     return $this->hasOne(Poli::class);
    // }

    public function poli()
    {
        return $this->hasOne('\App\Models\Poli', 'id', 'poli_id');
    }
    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter_id');
    }
    
    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'id', 'pasien_id');
    }
}
