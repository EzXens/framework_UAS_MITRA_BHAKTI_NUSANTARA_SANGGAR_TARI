<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dispensations', function (Blueprint $table) {
    $table->integer('letter_number')->nullable();
    $table->string('letter_code')->nullable(); // BN.11 atau BN.06
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispensations', function (Blueprint $table) {
            //
        });
    }
};
