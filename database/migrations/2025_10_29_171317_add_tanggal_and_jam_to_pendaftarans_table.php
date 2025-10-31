<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftarans', 'tanggal')) {
                $table->date('tanggal')->nullable()->after('nomor_antrian');
            }

            if (!Schema::hasColumn('pendaftarans', 'jam')) {
                $table->time('jam')->nullable()->after('tanggal');
            }
        });
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftarans', 'tanggal')) {
                $table->dropColumn('tanggal');
            }
            if (Schema::hasColumn('pendaftarans', 'jam')) {
                $table->dropColumn('jam');
            }
        });
    }
};
