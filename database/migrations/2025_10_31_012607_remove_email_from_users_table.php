<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Hapus kolom email hanya jika ada
        if (Schema::hasColumn('users', 'email')) {
            // Pastikan index unik tidak dihapus (biar aman)
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }
    }

    public function down()
    {
        // Tambahkan kembali kolom email jika belum ada
        if (!Schema::hasColumn('users', 'email')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email')->nullable()->unique();
            });
        }
    }
};
