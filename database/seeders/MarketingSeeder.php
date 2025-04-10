<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mst_marketing')->insert([
            [
                'nama_marketing' => 'Efi',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Karta',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Restu',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Rian',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Aji',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Dedi',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Veri',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Cecep',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Hasan',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Ade',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Saepul',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Nugraha',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Hendra',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Dian',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Anto',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_marketing' => 'Lainnya',
                'is_penerima_setoran' => true,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
        ]);
    }
}
