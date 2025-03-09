<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_marketing');
            $table->integer('jumlah_pengambilan_roti')->default(0);
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->integer('jumlah_retur')->default(0);
            $table->decimal('total_retur', 15, 2)->default(0);
            $table->decimal('total_setoran', 15, 2)->default(0);
            $table->decimal('uang_disetor', 15, 2)->default(0);
            $table->decimal('sisa_piutang', 15, 2)->default(0);
            $table->date('tanggal_setor')->nullable();
            $table->string('penerima_setoran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
