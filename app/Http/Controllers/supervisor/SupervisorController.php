<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class SupervisorController extends Controller
{
    public function penjualanSupervisor()
    {
        // Mengambil data transaksi untuk supervisor
        $transaksi = Transaksi::all(['id', 'tanggal', 'nama_marketing', 'jumlah_pengambilan_roti', 'harga_satuan', 'total_harga']);

        // Mengirimkan data ke view transaksi.penjualan untuk supervisor
        return view('supervisor.penjualan', compact('transaksi'));
    }

    public function returSupervisor()
    {
        // Mengambil semua data transaksi
        $transaksi = Transaksi::all(['id', 'tanggal', 'nama_marketing', 'jumlah_pengambilan_roti', 'jumlah_retur', 'harga_satuan', 'total_retur']);

        // Mengirimkan hanya kolom 6-10 ke view transaksi.penjualan
        return view('supervisor.retur', compact('transaksi'));
    }

    public function setorSupervisor()
    {
        // Mengambil semua data transaksi
        $transaksi = Transaksi::all(['id', 'tanggal', 'nama_marketing', 'total_setoran', 'uang_disetor', 'sisa_piutang', 'tanggal_setor', 'penerima_setoran']);

        // Mengirimkan hanya kolom 6-10 ke view transaksi.penjualan
        return view('supervisor.setor', compact('transaksi'));
    }

    
}
