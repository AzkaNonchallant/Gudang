<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'stok',
        'harga',
        'minimum_stok',
        'tanggal_masuk',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
