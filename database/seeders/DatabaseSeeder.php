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
        // ✅ Admin
        User::firstOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // ✅ Staff Gudang
        User::firstOrCreate(
            ['email' => 'staff@mail.com'],
            [
                'name' => 'Staff Gudang',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]
        );

        // ✅ Viewer
        User::firstOrCreate(
            ['email' => 'viewer@mail.com'],
            [
                'name' => 'Viewer',
                'password' => Hash::make('password123'),
                'role' => 'viewer',
            ]
        );
    }
}
