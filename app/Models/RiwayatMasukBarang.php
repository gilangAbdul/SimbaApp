<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMasukBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class, 'nip_petugas', 'nip');
    }
    public function barangs()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
