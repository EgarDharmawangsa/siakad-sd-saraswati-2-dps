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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nik', 25)->unique();
            $table->string('nip', 25)->unique()->nullable();
            $table->string('nipppk', 25)->unique()->nullable();
            $table->string('nama_pegawai');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_telepon_rumah', 15)->nullable();
            $table->string('no_telepon_seluler', 15);
            $table->string('e_mail')->unique()->nullable();
            $table->string('jabatan')->nullable();
            $table->string('status_perkawinan');
            $table->string('status_kepegawaian')->nullable();
            $table->string('ijazah_terakhir', 5)->nullable();
            $table->integer('tahun_ijazah')->nullable();
            $table->string('posisi');
            $table->string('status_sertifikasi');
            $table->integer('tahun_sertifikasi')->nullable();
            $table->date('permulaan_kerja');
            $table->date('permulaan_kerja_sds2');
            $table->string('no_sk', 25)->unique()->nullable();
            $table->date('tanggal_sk_terakhir')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
