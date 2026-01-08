<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::table('place_rentals')
            ->where('letter_code', 'BN.12')
            ->update(['letter_code' => 'BN.10']);
    }

    public function down()
    {
        DB::table('place_rentals')
            ->where('letter_code', 'BN.10')
            ->update(['letter_code' => 'BN.12']);
    }
};
