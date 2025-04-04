<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mst_wilayah')->insert([
            [
                'nama_toko' => 'Pasar Jaya',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.2088,106.8456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_toko' => 'Pasar Loak',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.2000,106.8167',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_toko' => 'Kampung Asem',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.2100,106.8000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_toko' => 'Pasar Kembang',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.1900,106.8300',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_toko' => 'Pasar Minggu',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.2700,106.8400',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
