<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tr_transaksi')->insert([
            [
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'id_marketing' => 1,
                'id_roti' => 1, 
                'id_toko' => 1, 
                'jumlah_pengambilan' => 50, 
                'total_harga' => 75000,
                'total_setoran' => 50000,
                'total_retur' => 10000,
                'status' => 'Belum Lunas',
                'catatan' => 'Pembayaran sorehari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now()->subDay()->format('Y-m-d'),
                'id_marketing' => 2,
                'id_roti' => 2, 
                'id_toko' => 2, 
                'jumlah_pengambilan' => 60, 
                'total_harga' => 100000,
                'total_setoran' => 100000,
                'total_retur' => 0,
                'status' => 'Lunas',
                'catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now()->subDay()->format('Y-m-d'),
                'id_marketing' => 2,
                'id_roti' => 1, 
                'id_toko' => 3, 
                'jumlah_pengambilan' => 40,
                'total_harga' => 80000,
                'total_setoran' => 80000,
                'total_retur' => 0,
                'status' => 'Lunas',
                'catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
