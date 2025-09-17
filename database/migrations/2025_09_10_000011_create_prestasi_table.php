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
            $table->foreignId('id_siswa')->nullable()->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->string('nama_prestasi', 100);
            $table->integer('jenis');
            $table->string('tingkat', 15);
            $table->string('peringkat', 15);
            $table->string('penyelenggara', 50);
            $table->date('tanggal');
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
