<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_toko' => 'Pasar Suryakencana',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.603565786485116,106.79985242607354',
            ],
            [
                'nama_toko' => 'Pasar Sukasari',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.618237977312022,106.81280025248655',
            ],
            [
                'nama_toko' => 'Pasar Kebon Kembang Bogor',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.592602056885956,106.79227594139395',
            ],
            [
                'nama_toko' => 'Pasar Merdeka',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.5921540564306,106.78711219481522',
            ],
            [
                'nama_toko' => 'Ciawi Market',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.656256532564859,106.84715133714512',
            ],
            [
                'nama_toko' => 'Pasar Induk Kemang (TU) Bogor',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.538516112479245,106.76995427947227',
            ],
            [
                'nama_toko' => 'Kantor Pusat Perumda Pasar Pakuan Jaya',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.592707519861092,106.79193642549943',
            ],
            [
                'nama_toko' => 'Gunung Batu',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.595873162122021,106.77945296538752',
            ],
            [
                'nama_toko' => 'Pasar Dramaga',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.575210769874572,106.7400439389926',
            ],
            [
                'nama_toko' => 'Pasar Jambu Dua',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.570174626981408,106.80733249826552',
            ],
            [
                'nama_toko' => 'Pasar Tanah Baru',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.582721905652825,106.82185626413084',
            ],
            [
                'nama_toko' => 'Tanah Sereal (Air Mancur)',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.581438759743903,106.79692780788166',
            ],
            [
                'nama_toko' => 'Malabar',
                'lokasi_toko' => 'https://maps.google.com/?q=-6.596946569888729,106.80695589567283',
            ]
        ];

        foreach ($data as $item) {
            DB::table('mst_wilayah')->updateOrInsert(
                ['nama_toko' => $item['nama_toko']], // key unik
                array_merge($item, [
                    'created_at' => now()->setDate(2023, 1, 1),
                    'updated_at' => now()->setDate(2023, 1, 1),
                ])
            );
        }
    }
}
