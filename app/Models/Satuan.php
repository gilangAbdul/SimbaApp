<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    public $timestamps = false;

    public function master_barang()
    {
        return $this->hasMany(MasterBarang::class);
    }
}
