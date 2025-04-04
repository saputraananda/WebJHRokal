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
        Schema::create('tr_setoran', function (Blueprint $table) {
            $table->id('id_setoran');
            $table->unsignedBigInteger('id_piutang');
            $table->foreign('id_piutang')->references('id_piutang')->on('tr_piutang')->onDelete('cascade');
            $table->date('tanggal_setor');
            $table->decimal('jumlah_setor', 10, 2);
            $table->unsignedBigInteger('id_penerima');
            $table->foreign('id_penerima')->references('id_marketing')->on('mst_marketing')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
