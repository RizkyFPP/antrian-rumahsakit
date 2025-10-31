<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('pendaftarans', 'loket')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->string('loket')->nullable()->after('status');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('pendaftarans', 'loket')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->dropColumn('loket');
            });
        }
    }
};
