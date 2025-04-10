<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SetoranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tr_setoran')->insert([
            [
                'id_piutang' => 1,
                'tanggal_setor' => now()->setDate(2023, 2, 5),
                'jumlah_setor' => 15000,
                'id_penerima' => 3, 
                'created_at' => now()->setDate(2023, 2, 5),
                'updated_at' => now()->setDate(2023, 2, 5),
            ]
        ]);
    }
}