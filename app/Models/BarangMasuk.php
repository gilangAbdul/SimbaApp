<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function riwayat_masuk_barang_id()
    {
        return $this->belongsTo(RiwayatMasukBarang::class);
    }

    public function master_barang()
    {
        return $this->belongsTo(MasterBarang::class);
    }
}
