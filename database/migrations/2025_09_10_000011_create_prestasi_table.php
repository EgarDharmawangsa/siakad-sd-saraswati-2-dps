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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->string('nama_prestasi', 100);
            $table->string('penyelenggara', 50);
            $table->string('jenis', 15); 
            $table->string('peringkat', 15); 
            $table->string('peringkat_lainnya', 50)->nullable();
            $table->string('tingkat', 15); 
            $table->string('wilayah', 25);
            $table->date('tanggal');
            $table->string('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
