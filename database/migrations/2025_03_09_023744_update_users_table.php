<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom yang tidak diperlukan
            $table->dropColumn(['name', 'email', 'email_verified_at']);

            // Tambahkan kolom username dan role
            $table->string('username')->unique()->after('id');
            $table->string('role')->default('admin')->after('password'); // Bisa 'admin' atau 'supervisor'
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali kolom yang dihapus jika rollback
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // Hapus kolom yang baru ditambahkan
            $table->dropColumn(['username', 'role']);
        });
    }
};

