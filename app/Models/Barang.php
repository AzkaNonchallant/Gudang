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

    /**
     * Auto generate kode barang
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            if (empty($barang->kode)) {
                $barang->kode = 'BRG-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
            }
        });
    }

    /**
     * Relasi: Barang milik 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
