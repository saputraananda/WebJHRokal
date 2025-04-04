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
                'nama_marketing' => 'Asep',
                'is_penerima_setoran' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_marketing' => 'Ujang',
                'is_penerima_setoran' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_marketing' => 'Wawan',
                'is_penerima_setoran' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
