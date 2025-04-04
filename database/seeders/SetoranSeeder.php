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
                'tanggal_setor' => Carbon::now()->format('Y-m-d'),
                'jumlah_setor' => 15000,
                'id_penerima' => 3, // Wawan sebagai penerima
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}