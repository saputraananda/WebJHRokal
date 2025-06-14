<?php

namespace App\Http\Controllers\admin;

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

class AdminController extends Controller
{

    //Scorecard untuk halaman dashboard Admin
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
            ->limit(13)
            ->get()
            ->reverse(); // Biar dari bulan lama ke terbaru

        // Format untuk frontend
        $labelBulanan = $monthly->pluck('label'); // Jan, Feb, dst
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

        // Peta Persebaran Lokasi Toko
        $lokasiToko = ViewCombineTransaction::selectRaw('
        nama_toko,
        lokasi_toko,
        SUM(jumlah_pengambilan) - SUM(jumlah_retur) as total_penjualan
    ')
            ->groupBy('nama_toko', 'lokasi_toko')
            ->get()
            ->map(function ($item) {
                // Parsing koordinat dari URL Google Maps
                if (preg_match('/\?q=([-0-9\.]+),([-0-9\.]+)/', $item->lokasi_toko, $matches)) {
                    $item->latitude = $matches[1];
                    $item->longitude = $matches[2];
                } else {
                    $item->latitude = null;
                    $item->longitude = null;
                }
                return $item;
            });

        return view('admin.index', compact(
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
            'jumlahReturMarketing',
            'lokasiToko'
        ));
    }

    //Mengirim data transaksi dengan relasinya (marketing, roti, retur) ke page admin/penjualan.blade.php
    public function getPenjualanAdmin()
    {
        // Mengambil data transaksi dengan urutan descending berdasarkan id_transaksi
        $transaksi = Transaksi::with(['marketing', 'roti', 'retur'])
            ->orderBy('tanggal', 'desc') // Urutkan descending berdasarkan tanggal
            ->get();

        return view('admin.penjualan', compact('transaksi'));
    }

    //Mengirim data transaksi dengan relasinya (marketing, roti, retur) ke page admin/retur.blade.php
    public function retur()
    {
        $transaksi = Transaksi::whereHas('retur') // hanya ambil transaksi yang punya retur
            ->with(['marketing', 'roti', 'retur'])
            ->orderBy('tanggal', 'desc') // Urutkan descending berdasarkan tanggal
            ->get();

        return view('admin.retur', compact('transaksi'));
    }


    //Mengirim data transaksi dengan relasinya (marketing, roti, retur) ke page admin/piutang.blade.php
    public function piutang()
    {
        // Ambil hanya transaksi yang punya piutang (saldo masih ada)
        $transaksi = Transaksi::whereHas('piutang', function ($query) {
            $query->where('saldo_piutang', '>', 0);
        })
            ->with(['marketing', 'roti', 'retur', 'piutang'])
            ->get();

        return view('admin.piutang', compact('transaksi'));
    }

    public function create()
    {
        $marketing = Marketing::all();
        $roti = Roti::all();
        $wilayah = Wilayah::all();
        $penerima = Marketing::where('is_penerima_setoran', true)->get();
        return view('admin.create', compact('marketing', 'roti', 'penerima', 'wilayah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_marketing' => 'required|exists:mst_marketing,id_marketing',
            'id_roti' => 'required|exists:mst_roti,id_roti',
            'id_toko' => 'required|exists:mst_wilayah,id_toko',
            'jumlah_pengambilan' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'jumlah_retur' => 'nullable|integer|min:0',
            'total_retur' => 'nullable|numeric|min:0',
            'total_setoran' => 'required|numeric|min:0',
            'uang_disetor' => 'nullable|numeric|min:0',
            'sisa_piutang' => 'nullable|numeric|min:0',
            'tanggal_setor' => 'nullable|date',
            'id_penerima' => 'nullable|exists:mst_marketing,id_marketing',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Tentukan status dan saldo piutang
        $sisaPiutang = $validated['sisa_piutang'] ?? 0;
        $status = $sisaPiutang > 0 ? 'Belum Lunas' : 'Lunas';

        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'tanggal' => $validated['tanggal'],
            'id_marketing' => $validated['id_marketing'],
            'id_roti' => $validated['id_roti'],
            'id_toko' => $validated['id_toko'],
            'jumlah_pengambilan' => $validated['jumlah_pengambilan'],
            'total_harga' => $validated['total_harga'],
            'total_setoran' => $validated['total_setoran'],
            'total_retur' => $validated['total_retur'] ?? 0,
            'saldo_piutang' => $sisaPiutang,
            'status' => $status,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        // Pastikan jumlah_retur dan total_retur tidak null
        $validated['jumlah_retur'] = $validated['jumlah_retur'] ?? 0;
        $validated['total_retur'] = $validated['total_retur'] ?? 0;

        ReturDetail::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'id_roti' => $validated['id_roti'],
            'jumlah_retur' => $validated['jumlah_retur'],
            'total_retur' => $validated['total_retur'],
        ]);


        // Simpan piutang (selalu simpan piutang agar ada data setoran)
        $piutang = Piutang::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'total_piutang' => $validated['total_setoran'],
            'saldo_piutang' => $sisaPiutang,
            'status' => $status,
        ]);

        // Simpan setoran jika ada input valid
        if (
            isset($validated['uang_disetor']) &&
            $validated['uang_disetor'] > 0 &&
            !empty($validated['tanggal_setor']) &&
            !empty($validated['id_penerima'])
        ) {
            Setoran::create([
                'id_piutang' => $piutang->id_piutang,
                'tanggal_setor' => $validated['tanggal_setor'],
                'jumlah_setor' => $validated['uang_disetor'],
                'id_penerima' => $validated['id_penerima'],
            ]);
        }

        return redirect()->route('admin.penjualan')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with(['marketing', 'roti', 'retur', 'piutang.setoran'])->findOrFail($id);

        return view('admin.detail', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with([
            'marketing',
            'roti',
            'retur',
            'wilayah',
            'piutang.setoran.penerima'
        ])->findOrFail($id);

        // Hitung ulang jumlah setoran
        $jumlahSetoran = $transaksi->piutang?->setoran->sum('jumlah_setor') ?? 0;

        // Hitung ulang sisa piutang real-time
        $sisaPiutang = max($transaksi->total_setoran - $jumlahSetoran, 0);

        $marketing = Marketing::all();
        $roti = Roti::all();
        $wilayah = Wilayah::all();
        $penerima = Marketing::where('is_penerima_setoran', 1)->get();

        return view('admin.edit', compact(
            'transaksi',
            'marketing',
            'roti',
            'wilayah',
            'penerima',
            'sisaPiutang',
            'jumlahSetoran'
        ));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_marketing' => 'required|exists:mst_marketing,id_marketing',
            'id_roti' => 'required|exists:mst_roti,id_roti',
            'id_toko' => 'required|exists:mst_wilayah,id_toko',
            'jumlah_pengambilan' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'jumlah_retur' => 'nullable|integer|min:0',
            'total_retur' => 'nullable|numeric|min:0',
            'total_setoran' => 'required|numeric|min:0',
            'uang_disetor' => 'nullable|numeric|min:0',
            'sisa_piutang' => 'nullable|numeric|min:0',
            'tanggal_setor' => 'required|date',
            'id_penerima' => 'required|exists:mst_marketing,id_marketing',
            'catatan' => 'nullable|string|max:255'
        ]);

        $validated['sisa_piutang'] = max(0, ($validated['sisa_piutang'] ?? 0));

        // Update Transaksi
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'tanggal' => $validated['tanggal'],
            'id_marketing' => $validated['id_marketing'],
            'id_roti' => $validated['id_roti'],
            'id_toko' => $validated['id_toko'],
            'jumlah_pengambilan' => $validated['jumlah_pengambilan'],
            'total_harga' => $validated['total_harga'],
            'total_setoran' => $validated['total_setoran'],
            'total_retur' => $validated['total_retur'] ?? 0,
            'status' => $validated['sisa_piutang'] > 0 ? 'Belum Lunas' : 'Lunas',
            'catatan' => $validated['catatan'] ?? null,
        ]);

        // Update atau buat retur hanya jika jumlah_retur > 0
        if (!empty($validated['jumlah_retur']) && $validated['jumlah_retur'] > 0) {
            ReturDetail::updateOrCreate(
                ['id_transaksi' => $transaksi->id_transaksi],
                [
                    'id_roti' => $validated['id_roti'],
                    'jumlah_retur' => $validated['jumlah_retur'],
                    'total_retur' => $validated['total_retur'] ?? 0
                ]
            );
        } else {
            // Jika jumlah_retur = 0, hapus retur yang sudah ada
            ReturDetail::where('id_transaksi', $transaksi->id_transaksi)->delete();
        }

        // Update atau buat piutang
        $piutang = Piutang::updateOrCreate(
            ['id_transaksi' => $transaksi->id_transaksi],
            [
                'total_piutang' => $validated['total_setoran'],
                'saldo_piutang' => $validated['sisa_piutang'],
                'status' => $validated['sisa_piutang'] > 0 ? 'Belum Lunas' : 'Lunas'
            ]
        );

        // Validasi setoran hanya jika semua input lengkap
        if (
            !empty($validated['uang_disetor']) &&
            !empty($validated['tanggal_setor']) &&
            !empty($validated['id_penerima'])
        ) {
            // Batasi agar tidak melebihi total setoran
            $jumlahDisetor = min($validated['uang_disetor'], $validated['total_setoran']);

            Setoran::create([
                'id_piutang' => $piutang->id_piutang,
                'tanggal_setor' => $validated['tanggal_setor'],
                'jumlah_setor' => $jumlahDisetor,
                'id_penerima' => $validated['id_penerima']
            ]);
        }

        return redirect()->route('admin.penjualan')->with('success', 'Data transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Hapus retur dan piutang jika ada
        if ($transaksi->retur) {
            $transaksi->retur()->delete();
        }

        if ($transaksi->piutang) {
            $transaksi->piutang()->delete();
        }

        $transaksi->delete();

        return redirect()->route('admin.penjualan')->with('success', 'Transaksi berhasil dihapus.');
    }

}
