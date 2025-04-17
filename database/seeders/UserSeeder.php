<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin123@gmail.com',
            'nik' => '1234567890894672',
            'password' => 'admin123',
            'role_id' => '1', // admin
        ]);

        User::create([
            'name' => 'Wong Desa',
            'email' => 'wong@gmail.com',
            'nik' => '1234567890346781',
            'password' => 'wongdesa',
            'role_id' => '2', // admin
        ]);
    }
}
