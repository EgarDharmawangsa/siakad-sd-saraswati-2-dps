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
            $table->integer('nik');
            $table->integer('nip');
            $table->string('nama_pegawai');
            $table->integer('jenis_kelamin');
            $table->integer('agama');
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->integer('no_telepon_rumah');
            $table->integer('no_telepon_seluler');
            $table->string('e_mail');
            $table->string('pangkat', 20);
            $table->integer('status_perkawinan');
            $table->integer('status_kepagawaian');
            $table->string('gelar_ijazah', 5);
            $table->integer('tahun_ijazah');
            $table->integer('posisi');
            $table->boolean('status_sertifikasi');
            $table->integer('tahun_sertifikasi');
            $table->date('permulaan_kerja');
            $table->date('permulaan_kerja_sds2');
            $table->string('no_sk', 25);
            $table->date('tanggal_sk_terakhir');
            $table->string('golongan_ruang', 5);
            $table->string('foto');
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
