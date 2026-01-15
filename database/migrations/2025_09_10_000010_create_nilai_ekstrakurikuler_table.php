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
        Schema::create('nilai_ekstrakurikuler', function (Blueprint $table) {
            $table->id('id_nilai_ekstrakurikuler');
            $table->foreignId('id_semester')->constrained('semester', 'id_semester')->onDelete('cascade');
            $table->foreignId('id_peserta_ekstrakurikuler')->constrained('peserta_ekstrakurikuler', 'id_peserta_ekstrakurikuler')->onDelete('cascade');
            $table->unique(['id_semester', 'id_peserta_ekstrakurikuler'], 'unique_nilai_ekstrakurikuler');
            $table->decimal('nilai', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_ekstrakurikuler');
    }
};
