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
        Schema::create('nilai_mata_pelajaran', function (Blueprint $table) {
            $table->id('id_nilai_mata_pelajaran');
            $table->foreignId('id_semester')->constrained('semester', 'id_semester')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran', 'id_mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->unique(['id_semester', 'id_mata_pelajaran', 'id_siswa'], 'unique_nilai_mata_pelajaran');
            $table->integer('jumlah_portofolio')->default(0);
            $table->json('nilai_portofolio')->nullable();
            $table->decimal('nilai_ub_1', 5, 2)->default(0);
            $table->decimal('nilai_ub_2', 5, 2)->default(0);
            $table->decimal('nilai_uts', 5, 2)->default(0);
            $table->decimal('nilai_uas', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_mata_pelajaran');
    }
};
