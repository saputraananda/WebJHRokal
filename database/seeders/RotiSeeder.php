<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RotiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mst_roti')->insert([
            [
                'nama_roti' => 'Coklat',
                'harga_satuan' => 3000,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_roti' => 'Keju',
                'harga_satuan' => 3000,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_roti' => 'Coklat Keju',
                'harga_satuan' => 3500,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
            [
                'nama_roti' => 'Abon',
                'harga_satuan' => 3500,
                'created_at' => now()->setDate(2023, 1, 1),
                'updated_at' => now()->setDate(2023, 1, 1),
            ],
        ]);
    }
}
