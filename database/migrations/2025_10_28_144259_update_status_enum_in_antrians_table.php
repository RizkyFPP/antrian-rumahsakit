<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('antrians', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'dilewati'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('antrians', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai'])->change();
        });
    }
};