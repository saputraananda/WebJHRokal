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
                'jumlah_pengambilan' => 700, 
                'total_harga' => 2100000,
                'total_setoran' => 2000000,
                'total_retur' => 60000,
                'status' => 'Belum Lunas',
                'catatan' => 'Pembayaran sorehari',
                'created_at' => now()->setDate(2023, 2, 5),
                'updated_at' => now()->setDate(2023, 2, 5),
            ],
        ]);
    }
}
