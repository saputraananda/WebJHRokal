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
            'username' => 'Efi',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Karta',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Restu',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Rian',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Aji',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Dedi',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Veri',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Cecep',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Hasan',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Ade',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Saepul',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Nugraha',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Hendra',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Dian',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Anto',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        
        // Buat Supervisor
        User::create([
            'username' => 'yuyun',
            'password' => Hash::make('supervisor'),
            'role' => 'supervisor',
        ]);

        User::create([
            'username' => 'Kiki',
            'password' => Hash::make('supervisor'),
            'role' => 'supervisor',
        ]);
    }
}

