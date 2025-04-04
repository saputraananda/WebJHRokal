<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tanggal');

            $table->unsignedBigInteger('id_marketing');
            $table->foreign('id_marketing')->references('id_marketing')->on('mst_marketing')->onDelete('cascade');

            $table->unsignedBigInteger('id_roti'); 
            $table->foreign('id_roti')->references('id_roti')->on('mst_roti')->onDelete('cascade'); 

            $table->unsignedBigInteger('id_toko'); 
            $table->foreign('id_toko')->references('id_toko')->on('mst_wilayah')->onDelete('cascade'); 

            $table->integer('jumlah_pengambilan');
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->decimal('total_setoran', 10, 2)->default(0);
            $table->decimal('total_retur', 10, 2)->default(0);
            // $table->decimal('saldo_piutang', 10, 2)->default(0);
            $table->enum('status', ['Belum Setor', 'Belum Lunas', 'Lunas'])->default('Belum Setor');
            $table->string('catatan')->nullable(); // Catatan tambahan (opsional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_transaksi'); 
    }
};

