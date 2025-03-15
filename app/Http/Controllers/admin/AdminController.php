<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung total transaksi dan total uang disetor
        $jumlahTransaksi = Transaksi::count();
        $pengambilanRoti = Transaksi::sum('jumlah_pengambilan_roti');
        $jumlahRetur = Transaksi::sum('jumlah_retur');
        $totalUangDisetor = Transaksi::sum('uang_disetor');
        $totalPiutang = Transaksi::sum('sisa_piutang');
        $saldo = Transaksi::sum('uang_disetor') + Transaksi::sum('sisa_piutang') ;
        return view('admin.index', compact('jumlahTransaksi','pengambilanRoti','jumlahRetur','totalUangDisetor','totalPiutang','saldo')); // mengirimkan variabel transaksis ke view
    }

    public function penjualanSupervisor()
    {
        // Mengambil data transaksi untuk supervisor
        $transaksi = Transaksi::all(['id', 'tanggal', 'nama_marketing', 'jumlah_pengambilan_roti', 'harga_satuan', 'total_harga']);

        // Mengirimkan data ke view transaksi.penjualan untuk supervisor
        return view('supervisor.penjualan', compact('transaksi'));
    }

    public function retur()
    {
        // Mengambil semua data transaksi
        $transaksi = Transaksi::all(['id', 'tanggal', 'nama_marketing', 'jumlah_pengambilan_roti', 'jumlah_retur', 'harga_satuan', 'total_retur']);

        // Mengirimkan hanya kolom 6-10 ke view transaksi.penjualan
        return view('admin.retur', compact('transaksi'));
    }

    public function setor()
    {
        // Mengambil semua data transaksi
        $transaksi = Transaksi::all(['id', 'tanggal', 'nama_marketing', 'total_setoran', 'uang_disetor', 'sisa_piutang', 'tanggal_setor', 'penerima_setoran']);

        // Mengirimkan hanya kolom 6-10 ke view transaksi.penjualan
        return view('admin.setor', compact('transaksi'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'nama_marketing' => 'required|string|max:255',
            'jumlah_pengambilan_roti' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'jumlah_retur' => 'required|integer|min:0',
            'total_retur' => 'required|numeric|min:0',
            'total_setoran' => 'required|numeric|min:0',
            'uang_disetor' => 'required|numeric|min:0',
            'sisa_piutang' => 'required|numeric',
            'tanggal_setor' => 'nullable|date',
            'penerima_setoran' => 'nullable|string|max:255',
        ]);

        // Hitung ulang nilai yang dihitung otomatis di form
        $validatedData['total_harga'] = $request->jumlah_pengambilan_roti * $request->harga_satuan;
        $validatedData['total_retur'] = $request->jumlah_retur * $request->harga_satuan;
        $validatedData['total_setoran'] = $validatedData['total_harga'] - $validatedData['total_retur'];
        $validatedData['sisa_piutang'] = $validatedData['total_setoran'] - $request->uang_disetor;

        // Jika uang disetor lebih besar dari total setoran, kurangi piutang yang ada
    if ($validatedData['sisa_piutang'] < 0) {
        $kelebihan = abs($validatedData['sisa_piutang']); // Ambil nilai kelebihan
        $validatedData['sisa_piutang'] = 0; // Set sisa piutang untuk transaksi baru menjadi 0

        // Ambil data piutang terakhir dari database (jika perlu)
        $transaksiTerakhir = Transaksi::latest()->first();
        if ($transaksiTerakhir) {
            $transaksiTerakhir->sisa_piutang -= $kelebihan;
            $transaksiTerakhir->save(); // Simpan pengurangan piutang
        }
    }

    // Simpan data baru ke database
    Transaksi::create($validatedData);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id); // Cari data transaksi berdasarkan ID
        return view('admin.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id); // Ambil data transaksi berdasarkan ID

        // Validasi data
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'nama_marketing' => 'required|string|max:255',
            'jumlah_pengambilan_roti' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'jumlah_retur' => 'required|integer|min:0',
            'uang_disetor' => 'required|numeric|min:0',
        ]);

        // Hitung ulang nilai otomatis
        $validatedData['total_harga'] = $request->jumlah_pengambilan_roti * $request->harga_satuan;
        $validatedData['total_retur'] = $request->jumlah_retur * $request->harga_satuan;
        $validatedData['total_setoran'] = $validatedData['total_harga'] - $validatedData['total_retur'];

        // Ambil data transaksi lama
        $transaksiLama = Transaksi::findOrFail($id);

        // Hitung ulang sisa piutang
        $sisaPiutangBaru = $validatedData['total_setoran'] - $request->uang_disetor;

        // Update sisa piutang di database
        $validatedData['sisa_piutang'] = max(0, $sisaPiutangBaru);

        // Update data transaksi
        $transaksiLama->update($validatedData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
