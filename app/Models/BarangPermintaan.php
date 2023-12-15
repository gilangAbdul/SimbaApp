<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPermintaan extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function riwayat_permintaan_id()
    {
        return $this->belongsTo(RiwayatPermintaan::class);
    }

    public function master_barang()
    {
        return $this->belongsTo(MasterBarang::class);
    }
}
