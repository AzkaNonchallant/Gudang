<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'stok',
        'harga',
        'minimum_stok',
        'tanggal_masuk',
    ];

    // helper untuk cek menipis
    public function getMenipisAttribute()
    {
        return $this->stok < $this->minimum_stok;
    }
}
