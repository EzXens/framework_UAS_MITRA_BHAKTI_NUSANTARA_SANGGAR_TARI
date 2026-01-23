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
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('scheduled_deletion_at')->nullable()->after('password')->comment('Waktu penghapusan terjadwal');
            $table->integer('deletion_days')->nullable()->after('scheduled_deletion_at')->comment('Jumlah hari untuk penghapusan');
            $table->softDeletes('deleted_at')->after('deletion_days')->comment('Waktu penghapusan aktual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['scheduled_deletion_at', 'deletion_days', 'deleted_at']);
        });
    }
};
