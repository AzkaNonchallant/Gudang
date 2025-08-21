<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder user admin
        User::firstOrCreate(
            ['email' => 'admin@mail.com'], // cek email sudah ada atau belum
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
            ]
        );

    }
}
