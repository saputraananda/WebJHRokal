<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mst_marketing', function (Blueprint $table) {
            $table->id('id_marketing');
            $table->string('nama_marketing')->unique();
            $table->boolean('is_penerima_setoran')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mst_marketing');
    }
};
