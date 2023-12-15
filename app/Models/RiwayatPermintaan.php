<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPermintaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function Petugas()
    {
        return $this->belongsTo(User::class, 'nip_petugas', 'nip');
    }
    public function Approve()
    {
        return $this->belongsTo(User::class, 'nip_penyetuju', 'nip');
    }
    public function barangs()
    {
        return $this->hasMany(BarangPermintaan::class);
    }
    public function Pemohon()
    {
        return $this->belongsTo(User::class, 'nip_pemohon', 'nip');
    }
    public function status()
    {
        return $this->belongsTo(StatusPersetujuan::class, 'status_persetujuan_id', 'id');
    }
}
