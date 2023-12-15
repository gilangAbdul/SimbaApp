<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public $timestamps = false;

    public function anggota_divisi()
    {
        return $this->hasMany(User::class);
    }
}
