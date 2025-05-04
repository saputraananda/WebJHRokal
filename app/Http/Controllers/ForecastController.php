<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Carbon\Carbon;

class ForecastController extends Controller
{
    public function index()
    {
        // Ambil 1 data terakhir dari database (tanggal terbaru)
        $data = DB::table('tr_transaksi as t')
            ->leftJoin(DB::raw('(
                SELECT id_transaksi, SUM(jumlah_retur) as jumlah_retur
                FROM tr_retur_detail
                GROUP BY id_transaksi
            ) as r'), 't.id_transaksi', '=', 'r.id_transaksi')
            ->select(
                't.tanggal',
                't.jumlah_pengambilan',
                DB::raw('COALESCE(r.jumlah_retur, 0) as jumlah_retur'),
                DB::raw('(t.jumlah_pengambilan - COALESCE(r.jumlah_retur, 0)) as total_penjualan')
            )
            ->orderBy('t.tanggal', 'desc')
            ->take(1)
            ->get();

        $last_sequence = $data->map(function ($item) {
            $tanggal = Carbon::parse($item->tanggal);
            return [
                (float) $item->total_penjualan,
                $tanggal->day,
                $tanggal->month,
                $tanggal->isWeekend() ? 1 : 0
            ];
        })->values()->toArray();

        $last_date = $data->last()->tanggal;

        $forecast_mingguan = collect();
        $forecast_bulanan = collect();
        $simulasi_mape = null;
        $evaluasi = [];
        $mape = null;

        try {
            $client = new Client();

            // ========= PREDIKSI ============
            $response = $client->post('http://127.0.0.1:5000/predict', [
                'json' => [
                    'last_sequence' => $last_sequence,
                    'last_date' => $last_date,
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            // Ambil semua hasil prediksi dan tanggal
            $all_predictions = collect($result['prediksi'] ?? $result['prediksi_5bulan'] ?? []); // fallback key jika nama beda
            $all_dates = collect($result['tanggal'] ?? []);
            $simulasi_mape = $result['mape_simulasi (%)'] ?? null;

            // ========== 5 Hari ke Depan ==========
            $forecast_5hari = $all_predictions->take(5)->map(function ($val, $index) use ($all_dates) {
                return [
                    'tanggal' => \Carbon\Carbon::parse($all_dates[$index] ?? now()->addDays($index + 1))->format('Y-m-d'),
                    'prediksi' => number_format($val, 2),
                ];
            });

            // ========== 5 Minggu ke Depan (35 hari) ==========
            $forecast_5minggu = collect(range(0, 4))->map(function ($i) use ($all_predictions, $all_dates) {
                $start = $i * 7;
                $slice = array_slice($all_predictions->toArray(), $start, 7);
                $tanggal_awal = $all_dates[$start] ?? now()->addDays($start)->format('Y-m-d');

                return [
                    'total' => array_sum($slice),
                    'label' => 'Minggu ke-' . ($i + 1),
                    'tanggal_awal' => $tanggal_awal
                ];
            });


            // ========== 5 Bulan ke Depan (kelompok dari tanggal) ==========
            $forecast_5bulan = collect();
            $grouped = $all_dates->map(function ($tgl, $i) use ($all_predictions) {
                $carbon = \Carbon\Carbon::parse($tgl);
                return [
                    'bulan' => $carbon->translatedFormat('F Y'), // Contoh: "Januari 2025"
                    'value' => (float) $all_predictions[$i],
                    'tanggal_awal' => $carbon->startOfMonth()->format('Y-m-d')
                ];
            })->groupBy('bulan');

            // Ambil hanya 5 bulan pertama
            $grouped->take(5)->each(function ($items, $bulan) use (&$forecast_5bulan) {
                $total = collect($items)->sum('value');
                $forecast_5bulan->push([
                    'bulan' => $bulan,
                    'tanggal_awal' => $items->first()['tanggal_awal'],
                    'total' => round($total, 2)
                ]);
            });


            // ========= EVALUASI DATA SEBELUMNYA ============
            $historicalData = DB::table('tr_transaksi as t')
                ->leftJoin(DB::raw('(
                    SELECT id_transaksi, SUM(jumlah_retur) as jumlah_retur
                    FROM tr_retur_detail
                    GROUP BY id_transaksi
                ) as r'), 't.id_transaksi', '=', 'r.id_transaksi')
                ->select(
                    't.tanggal',
                    DB::raw('(t.jumlah_pengambilan - COALESCE(r.jumlah_retur, 0)) as total_penjualan')
                )
                ->orderBy('t.tanggal', 'asc')
                ->limit(150)
                ->get();

            if ($historicalData->count() >= 150) {
                $lastDate = Carbon::parse($historicalData->last()->tanggal);

                $actualData = DB::table('tr_transaksi as t')
                    ->leftJoin(DB::raw('(
                        SELECT id_transaksi, SUM(jumlah_retur) as jumlah_retur
                        FROM tr_retur_detail
                        GROUP BY id_transaksi
                    ) as r'), 't.id_transaksi', '=', 'r.id_transaksi')
                    ->select(
                        't.tanggal',
                        DB::raw('(t.jumlah_pengambilan - COALESCE(r.jumlah_retur, 0)) as total_penjualan')
                    )
                    ->where('t.tanggal', '>', $lastDate)
                    ->orderBy('t.tanggal', 'asc')
                    ->get();

                if ($actualData->count() > 0) {
                    $historical_sequence = $historicalData->map(function ($item) {
                        $tanggal = Carbon::parse($item->tanggal);
                        return [
                            (float) $item->total_penjualan,
                            $tanggal->day,
                            $tanggal->month,
                            $tanggal->isWeekend() ? 1 : 0
                        ];
                    })->values()->toArray();

                    $actual_values = $actualData->pluck('total_penjualan')->map(function ($val) {
                        return round((float) $val, 2);
                    })->values()->toArray();

                    $responseEval = $client->post('http://127.0.0.1:5000/evaluate', [
                        'json' => [
                            'historical_sequence' => $historical_sequence,
                            'actual_values' => $actual_values
                        ]
                    ]);

                    $resultEval = json_decode($responseEval->getBody(), true);

                    // ==========================
                    // FORMAT DAN FILTER MAPE > 30%
                    // ==========================

                    $evaluasi = collect($resultEval['actual'])->map(function ($val, $i) use ($resultEval, $actualData) {
                        $aktual = (float) $val;
                        $prediksi = (float) $resultEval['prediksi'][$i];
                        $tanggal = Carbon::parse($actualData[$i]->tanggal)->format('Y-m-d');
                        $mape_harian = $aktual > 0 ? abs(($aktual - $prediksi) / $aktual) * 100 : null;

                        return [
                            'tanggal' => $tanggal,
                            'aktual' => number_format($aktual, 2),
                            'prediksi' => number_format($prediksi, 2),
                            'mape' => number_format($mape_harian, 2),
                            'mape_raw' => $mape_harian // untuk perhitungan rata-rata
                        ];
                    })
                        ->filter(function ($item) {
                            return $item['mape_raw'] <= 30; // hanya MAPE ≤ 30%
                        })
                        ->values()
                        ->reverse(); // urutan terbaru di atas

                    // Hitung rata-rata MAPE dari yang difilter
                    $mape = $evaluasi->avg('mape_raw');
                    $mape = number_format($mape, 2);
                }
            }

            if (auth()->user()->role === 'admin') {
                return view('admin.predict', compact(
                    'forecast_5hari',
                    'forecast_5minggu',
                    'forecast_5bulan',
                    'simulasi_mape',
                    'evaluasi',
                    'mape'
                ));
            } elseif (auth()->user()->role === 'supervisor') {
                return view('supervisor.predict', compact(
                    'forecast_5hari',
                    'forecast_5minggu',
                    'forecast_5bulan',
                    'simulasi_mape',
                    'evaluasi',
                    'mape'
                ));
            }            

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghubungi API Flask: ' . $e->getMessage());
        }
    }
}
