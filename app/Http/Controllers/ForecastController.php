<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{
    public function index()
    {
        // 1. Ambil dan hitung total penjualan harian
        $data = DB::table('tr_transaksi as t')
            ->leftJoin('tr_retur_detail as r', 't.id_transaksi', '=', 'r.id_transaksi')
            ->select(
                't.tanggal',
                DB::raw('SUM(t.jumlah_pengambilan - IFNULL(r.jumlah_retur, 0)) as total_penjualan')
            )
            ->groupBy('t.tanggal')
            ->orderBy('t.tanggal', 'desc')
            ->limit(1000)
            ->get()
            ->reverse()
            ->values();

        // 2. Format data ke array JSON-friendly
        $formatted = $data->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'total_penjualan' => $item->total_penjualan
            ];
        });

        // dd($formatted->toArray());

        // 3. Kirim ke Flask API
        try {
            $response = Http::post('http://127.0.0.1:5000/predict', [
                'data' => $formatted->toArray()
            ]);

            if ($response->successful()) {
                $hasil = $response->json();

                return view('admin.predict', [
                    'prediksi' => $hasil['prediksi_30_hari'],
                    'total_bulan_depan' => $hasil['total_bulan_depan'],
                    'mape' => $hasil['mape']
                ]);
            } else {
                return view('admin.predict')->with('error', 'Gagal memanggil API Flask.');
            }
        } catch (\Exception $e) {
            return view('admin.predict')->with('error', 'API error: ' . $e->getMessage());
        }
        
    }
}


