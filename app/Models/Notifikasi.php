<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function riwayat_masuk()
    {
        return $this->hasMany(RiwayatMasuk::class);
    }

    public function riwayat_permintaan()
    {
        return $this->hasMany(RiwayatPermintaan::class);
    }

}
