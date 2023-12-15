<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPersetujuan extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    public $timestamps = false;

    public function riwayat_permintaan()
    {
        return $this->hasMany(RiwayatPermintaan::class);
    }
}
