<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kepalaKeluarga()
    {
        return $this->hasOne(KepalaKeluarga::class, 'id', 'kepala_keluarga_id');
    }
}
