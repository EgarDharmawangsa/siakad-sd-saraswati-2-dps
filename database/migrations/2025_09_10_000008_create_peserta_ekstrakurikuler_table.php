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
        Schema::create('peserta_ekstrakurikuler', function (Blueprint $table) {
            $table->id('id_peserta_ekstrakurikuler');
            $table->foreignId('id_ekstrakurikuler')->constrained('ekstrakurikuler', 'id_ekstrakurikuler')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->unique(['id_ekstrakurikuler', 'id_siswa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_ekstrakurikuler');
    }
};
