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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('set null');
            $table->integer('no_kk');
            $table->integer('nik')->unique();
            $table->integer('nisn')->unique();
            $table->integer('nipd')->unique();
            $table->string('nama_siswa');
            $table->integer('jenis_kelamin');
            $table->integer('berat_badan');
            $table->integer('tinggi_badan');
            $table->integer('lingkar_kepala');
            $table->integer('jumlah_saudara_kandung');
            $table->integer('anak_ke_berapa');
            $table->integer('agama');
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->integer('no_registrasi_akta_lahir')->unique();
            $table->string('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('dusun', 20);
            $table->string('kelurahan', 20);
            $table->string('kecamatan', 20);
            $table->integer('kode_pos');
            $table->integer('lintang')->nullable();
            $table->integer('bujur')->nullable();
            $table->integer('jarak_rumah_sekolah');
            $table->integer('jenis_tinggal');
            $table->string('alat_transportasi', 20);
            $table->integer('no_telepon_rumah')->nullable();
            $table->integer('no_telepon_seluler');
            $table->string('e_mail')->unique()->nullable();
            $table->boolean('disabilitas');
            $table->string('keterangan_disabilitas', 100)->nullable();
            $table->string('sekolah_asal', 100)->nullable();
            $table->integer('no_peserta_un');
            $table->integer('no_seri_ijazah')->unique();
            // $table->id();
            $table->boolean('penerima_kps');
            $table->integer('no_kps')->unique()->nullable();
            $table->boolean('penerima_kip');
            $table->integer('no_kip')->unique()->nullable();
            $table->string('nama_kip', 100);
            $table->boolean('layak_pip');
            $table->string('alasan_layak_pip', 100)->nullable();
            $table->string('nama_bank', 15);
            $table->integer('no_rekening');
            $table->string('nama_rekening', 100);
            $table->integer('no_kks');
            $table->integer('nik_ayah')->unique()->nullable();
            $table->string('nama_ayah')->nullable();
            $table->integer('tahun_lahir_ayah')->nullable();
            $table->string('ijazah_terakhir_ayah', 15)->nullable();
            $table->integer('pekerjaan_ayah')->nullable();
            $table->integer('penghasilan_ayah')->nullable();
            $table->integer('nik_ibu')->unique()->nullable();
            $table->string('nama_ibu')->nullable();
            $table->integer('tahun_lahir_ibu')->nullable();
            $table->string('ijazah_terakhir_ibu', 15)->nullable();
            $table->integer('pekerjaan_ibu')->nullable();
            $table->integer('penghasilan_ibu')->nullable();
            $table->integer('nik_wali')->unique()->nullable();
            $table->string('nama_wali')->nullable();
            $table->integer('tahun_lahir_wali')->nullable();
            $table->string('ijazah_terakhir_wali', 15)->nullable();
            $table->integer('pekerjaan_wali')->nullable();
            $table->integer('penghasilan_wali')->nullable();
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
