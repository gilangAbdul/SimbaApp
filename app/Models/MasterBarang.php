<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MasterBarang extends Model
{
    use HasFactory, Sortable;

    protected $barangs;

    public $sortable= ['stok', 'nama_barang'];

    protected $guarded = ['create_at', 'updated_at', 'id'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function barang_masuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

}
