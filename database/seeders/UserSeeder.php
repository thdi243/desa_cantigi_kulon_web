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
            'name' => 'Tohadi',
            'email' => 'toadiasley243@gmail.com',
            'nik' => '3212170204030001',
            'password' => 'admin123',
            'role_id' => '1', // admin
        ]);
    }
}
