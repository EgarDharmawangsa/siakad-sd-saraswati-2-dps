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
            $table->string('nik', 16)->unique();
            $table->string('nip', 18)->unique()->nullable();
            $table->string('nipppk', 18)->unique()->nullable();
            $table->string('nama_pegawai');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_telepon_rumah', 15)->nullable();
            $table->string('no_telepon_seluler', 15);
            $table->string('e_mail')->unique()->nullable();
            $table->enum('jabatan', ['Pengatur Muda | II/a', 'Pengatur Muda Tk. I | II/b', 'Pengatur | II/c', 'Pengatur Tk. I | II/d', 'Penata Muda | III/a', 'Penata Muda Tk. I | III/b', 'Penata | III/c', 'Penata Tk. I | III/d', 'Pembina | IV/a', 'Pembina Tk. I | IV/b', 'Pembina Utama Muda | IV/c', 'Pembina Utama Madya | IV/d', 'Pembina Utama | IV/e',])->nullable();
            $table->enum('status_perkawinan', ['Sudah', 'Pernah', 'Belum']);
            $table->enum('status_kepegawaian', ['PNS', 'PPPK', 'Honorer', 'Kontrak', 'Tetap', 'Tidak Tetap'])->nullable();
            $table->string('ijazah_terakhir', 5)->nullable();
            $table->integer('tahun_ijazah')->nullable();
            $table->enum('posisi', ['Staf Tata Usaha', 'Guru', 'Pegawai Perpustakaan', 'Pegawai Kebersihan', 'Satuan Pengamanan'])->nullable();
            $table->enum('status_sertifikasi', ['Sudah', 'Belum']);
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
