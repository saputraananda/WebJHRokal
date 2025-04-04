<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mst_wilayah', function (Blueprint $table) {
            $table->id('id_toko');
            $table->string('nama_toko')->unique();
            $table->string('lokasi_toko')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mst_wilayah');
    }
};

