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
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->string('nim_atau_id'); // Identitas dasar mahasiswa/pasien
            $table->string('nama_obat');
            $table->integer('jumlah');
            $table->string('aturan_pakai'); // Contoh: 3x1 setelah makan
            $table->integer('estimasi_harga_obat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_obats');
    }
};
