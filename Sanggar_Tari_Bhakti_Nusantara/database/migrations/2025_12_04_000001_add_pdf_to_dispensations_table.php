<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dispensations', function (Blueprint $table) {
            $table->string('pdf')->nullable()->after('template');
        });
    }

    public function down()
    {
        Schema::table('dispensations', function (Blueprint $table) {
            $table->dropColumn('pdf');
        });
    }
};
