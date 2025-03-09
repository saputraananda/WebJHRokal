<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat Admin
        User::create([
            'username' => 'Hantu11',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Buat Supervisor
        User::create([
            'username' => 'yuyun',
            'password' => Hash::make('supervisor'),
            'role' => 'supervisor',
        ]);
    }
}

