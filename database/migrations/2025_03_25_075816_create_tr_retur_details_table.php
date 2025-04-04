<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tr_retur_detail', function (Blueprint $table) {
            $table->id('id_retur');
            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('tr_transaksi')->onDelete('cascade');
            $table->unsignedBigInteger('id_roti');
            $table->foreign('id_roti')->references('id_roti')->on('mst_roti')->onDelete('cascade');
            $table->integer('jumlah_retur');
            $table->decimal('total_retur', 10, 2);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_details');
    }
};
