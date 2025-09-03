<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Field yang bisa diisi mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahin role biar bisa diisi langsung
    ];

    /**
     * Field yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting field otomatis
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: 1 User bisa punya banyak Barang
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
