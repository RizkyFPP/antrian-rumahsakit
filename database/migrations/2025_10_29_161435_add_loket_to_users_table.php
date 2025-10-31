<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('name');
            }

            if (!Schema::hasColumn('users', 'loket')) {
                $table->integer('loket')->nullable()->after('username');
            }
        });
    }

    /**
     * Kembalikan migrasi.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'loket')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('loket');
            });
        }

        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }
    }
};
