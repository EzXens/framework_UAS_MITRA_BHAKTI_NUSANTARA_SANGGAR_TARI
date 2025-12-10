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
            if (!Schema::hasColumn('dispensations', 'letter_number')) {
                $table->integer('letter_number')->nullable()->after('id');
            }
            if (!Schema::hasColumn('dispensations', 'letter_code')) {
                $table->string('letter_code')->nullable()->after('letter_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispensations', function (Blueprint $table) {
            $table->dropColumn(['letter_number', 'letter_code']);
        });
    }
};
