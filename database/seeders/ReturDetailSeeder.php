<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tr_retur_detail')->insert([
            [
                'id_transaksi' => 1,
                'id_roti' => 2,
                'jumlah_retur' => 4,
                'total_retur' => 10000,
                'created_at' => now()->setDate(2023, 2, 5),
                'updated_at' => now()->setDate(2023, 2, 5),
            ]
        ]);
    }
}
