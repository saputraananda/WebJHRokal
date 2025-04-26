<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_combine_transaction");

        DB::statement("CREATE VIEW v_combine_transaction AS
            SELECT
                t.id_transaksi,
                t.tanggal,
                m.id_marketing,
                m.nama_marketing,
                wh.nama_toko,
                wh.lokasi_toko,
                r.nama_roti,
                t.jumlah_pengambilan,
                rd.jumlah_retur,
                r.harga_satuan,
                t.total_harga,
                t.total_retur,
                t.total_setoran,
                p.saldo_piutang,
                t.status AS status_transaksi,
                p.total_piutang,
                p.status AS status_piutang,
                s.tanggal_setor,
                s.jumlah_setor,
                s.id_penerima,
                penerima.nama_marketing AS nama_penerima_setoran,
                t.catatan

            FROM tr_transaksi t
            LEFT JOIN mst_marketing m ON t.id_marketing = m.id_marketing
            LEFT JOIN mst_roti r ON t.id_roti = r.id_roti
            LEFT JOIN mst_wilayah wh ON t.id_toko = wh.id_toko
            LEFT JOIN tr_retur_detail rd ON rd.id_transaksi = t.id_transaksi
            LEFT JOIN tr_piutang p ON t.id_transaksi = p.id_transaksi
            LEFT JOIN tr_setoran s ON p.id_piutang = s.id_piutang
            LEFT JOIN mst_marketing penerima ON s.id_penerima = penerima.id_marketing
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_combine_transaction");
    }
};

