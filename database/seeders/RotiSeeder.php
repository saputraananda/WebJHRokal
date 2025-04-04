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
                'nama_roti' => 'Roti Sobek Coklat',
                'harga_satuan' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_roti' => 'Roti Tawar Kupas',
                'harga_satuan' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_roti' => 'Roti Isi Keju',
                'harga_satuan' => 6500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
