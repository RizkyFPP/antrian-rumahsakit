<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pendaftarans', 'nomor_antrian')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->string('nomor_antrian', 20)->change();
            });
        } else {
            // Jika belum ada kolomnya, buat baru
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->string('nomor_antrian', 20)->nullable()->after('no_bpjs');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pendaftarans', 'nomor_antrian')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->integer('nomor_antrian')->change();
            });
        }
    }
};
