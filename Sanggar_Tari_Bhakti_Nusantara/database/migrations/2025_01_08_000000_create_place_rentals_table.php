<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('place_rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('letter_number')->nullable();
            $table->string('letter_code')->default('BN.10');
            $table->string('to')->nullable(); // Kepada Yth
            $table->string('activity_name')->nullable(); // Nama Kegiatan
            $table->string('organizer')->nullable(); // Penyelenggara Acara
            $table->string('place_name')->nullable(); // Nama Tempat Peminjaman
            $table->text('rental_purpose')->nullable(); // Tujuan Peminjaman
            $table->string('day')->nullable(); // Hari
            $table->date('date_from')->nullable(); // Tanggal Dilaksanakan (dari)
            $table->date('date_to')->nullable(); // Tanggal Dilaksanakan (sampai)
            $table->string('time')->nullable(); // Waktu
            $table->string('city_province')->nullable(); // Kota/Provinsi
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('rejection_reason')->nullable();
            $table->string('template')->nullable(); // template filename in storage
            $table->string('pdf')->nullable(); // pdf filename in storage
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('place_rentals');
    }
};
