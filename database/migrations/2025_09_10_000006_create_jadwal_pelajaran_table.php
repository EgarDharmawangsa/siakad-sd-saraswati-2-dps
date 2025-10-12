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
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id('id_jadwal_pelajaran');
            $table->foreignId('id_kelas')->nullable()->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->foreignId('id_guru_mata_pelajaran')->nullable()->constrained('guru_mata_pelajaran', 'id_guru_mata_pelajaran')->onDelete('cascade');
            $table->string('kegiatan', 10);
            $table->string('hari', 10);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
