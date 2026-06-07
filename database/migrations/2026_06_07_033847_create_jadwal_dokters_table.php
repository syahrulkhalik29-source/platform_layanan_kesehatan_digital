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
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->string('nim_atau_id'); // Menyimpan identitas dasar mahasiswa
            $table->string('nama_dokter');
            $table->string('spesialisasi_dokter');
            $table->date('tanggal_booking');
            $table->time('jam_booking');
            $table->string('status_persetujuan')->default('pending'); // pending, disetujui, selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokters');
    }
};
