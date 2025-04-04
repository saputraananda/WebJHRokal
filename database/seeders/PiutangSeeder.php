<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PiutangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tr_piutang')->insert([
            [
                'id_transaksi' => 1,
                'total_piutang' => 15000,
                'saldo_piutang' => 15000,
                'status' => 'Belum Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
