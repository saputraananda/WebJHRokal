<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ViewCombineTransaction;
use App\Models\Marketing;
use App\Models\Roti;
use App\Models\Setoran;
use App\Models\Piutang;
use App\Models\ReturDetail;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class SupervisorController extends Controller
{
    public function getScorecard()
    {
        $jumlahTransaksi = ViewCombineTransaction::count();
        $pengambilanRoti = ViewCombineTransaction::sum('jumlah_pengambilan');
        $jumlahRetur = ViewCombineTransaction::sum('jumlah_retur');
        $totalUangDisetor = ViewCombineTransaction::sum('total_setoran') - ViewCombineTransaction::sum('saldo_piutang');
        $totalPiutang = ViewCombineTransaction::sum('saldo_piutang');
        $saldo = ViewCombineTransaction::sum('total_setoran');

        // Tambahan: Total per varian
        $coklat = ViewCombineTransaction::where('nama_roti', 'Coklat')->sum('jumlah_pengambilan');
        $keju = ViewCombineTransaction::where('nama_roti', 'Keju')->sum('jumlah_pengambilan');
        $coklatKeju = ViewCombineTransaction::where('nama_roti', 'Coklat Keju')->sum('jumlah_pengambilan');
        $abon = ViewCombineTransaction::where('nama_roti', 'Abon')->sum('jumlah_pengambilan');

        // Ambil 12 bulan terakhir -- Untuk chart pemantauan penjualan & retur
        $monthly = ViewCombineTransaction::selectRaw('
        DATE_FORMAT(tanggal, "%Y-%m") as bln,
        DATE_FORMAT(tanggal, "%b") as label,
        SUM(jumlah_pengambilan) as penjualan,
        SUM(jumlah_retur) as retur
        ')
            ->groupBy('bln', 'label')
            ->orderBy('bln', 'desc')
            ->limit(12)
            ->get()
            ->reverse(); // Biar dari bulan lama ke terbaru

        // Format untuk frontend
        $labelBulanan = $monthly->pluck('label'); 
        $penjualanBulanan = $monthly->pluck('penjualan');
        $returBulanan = $monthly->pluck('retur');

        // Ambil Top 5 Marketing berdasarkan Penjualan
        $topPenjualan = ViewCombineTransaction::selectRaw('nama_marketing, SUM(jumlah_pengambilan) as total_penjualan')
            ->groupBy('nama_marketing')
            ->orderByDesc('total_penjualan')
            ->limit(10)
            ->get();

        $labelPenjualanMarketing = $topPenjualan->pluck('nama_marketing');
        $jumlahPenjualanMarketing = $topPenjualan->pluck('total_penjualan');

        // Ambil Top 5 Marketing berdasarkan Retur
        $topRetur = ViewCombineTransaction::selectRaw('nama_marketing, SUM(jumlah_retur) as total_retur')
            ->groupBy('nama_marketing')
            ->orderByDesc('total_retur')
            ->limit(10)
            ->get();

        $labelReturMarketing = $topRetur->pluck('nama_marketing');
        $jumlahReturMarketing = $topRetur->pluck('total_retur');


        return view('supervisor.index', compact(
            'jumlahTransaksi',
            'pengambilanRoti',
            'jumlahRetur',
            'totalUangDisetor',
            'totalPiutang',
            'saldo',
            'coklat',
            'keju',
            'coklatKeju',
            'abon',
            'labelBulanan',
            'penjualanBulanan',
            'returBulanan',
            'labelPenjualanMarketing',
            'jumlahPenjualanMarketing',
            'labelReturMarketing',
            'jumlahReturMarketing'
        ));
    }

    //Mengirim data transaksi dengan relasinya (marketing, roti, retur) ke page supervisor/penjualan.blade.php
    public function getPenjualanSupervisor()
    {
        // Mengambil data transaksi dengan urutan descending berdasarkan id_transaksi
        $transaksi = Transaksi::with(['marketing', 'roti', 'retur'])
            ->orderBy('tanggal', 'desc') // Urutkan descending berdasarkan tanggal
            ->get();

        return view('supervisor.penjualan', compact('transaksi'));
    }

    //Mengirim data transaksi dengan relasinya (marketing, roti, retur) ke supervisor/retur.blade.php
    public function getReturSupervisor()
    {
        $transaksi = Transaksi::whereHas('retur') // hanya ambil transaksi yang punya retur
            ->with(['marketing', 'roti', 'retur'])
            ->orderBy('tanggal', 'desc') // Urutkan descending berdasarkan tanggal
            ->get();

        return view('supervisor.retur', compact('transaksi'));
    }

    public function getDetailSupervisor($id)
    {
        $transaksi = Transaksi::with(['marketing', 'roti', 'retur', 'piutang.setoran'])->findOrFail($id);

        return view('supervisor.detail', compact('transaksi'));
    }

    //Mengirim data transaksi dengan relasinya (marketing, roti, retur) ke page admin/piutang.blade.php
    public function getPiutangSupervisor()
    {
        // Ambil hanya transaksi yang punya piutang (saldo masih ada)
        $transaksi = Transaksi::whereHas('piutang', function ($query) {
            $query->where('saldo_piutang', '>', 0);
        })
            ->with(['marketing', 'roti', 'retur', 'piutang'])
            ->get();

        return view('supervisor.piutang', compact('transaksi'));
    }

    
}
