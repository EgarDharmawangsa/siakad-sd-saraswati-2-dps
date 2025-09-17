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
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->integer('no_kk');
            $table->integer('nik');
            $table->integer('nisn');
            $table->integer('nipd');
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
            $table->integer('no_registrasi_akta_lahir');
            $table->string('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('dusun', 20);
            $table->string('kelurahan', 20);
            $table->string('kecamatan', 20);
            $table->integer('kode_pos');
            $table->integer('lintang');
            $table->integer('bujur');
            $table->integer('jarak_rumah_sekolah');
            $table->integer('jenis_tinggal');
            $table->string('alat_transportasi', 20);
            $table->integer('no_telepon_rumah');
            $table->integer('no_telepon_seluler');
            $table->string('e_mail')->unique();
            $table->boolean('disabilitas');
            $table->string('keterangan_disabilitas', 100);
            $table->string('sekolah_asal', 100);
            $table->integer('no_peserta_un');
            $table->integer('no_seri_ijazah');
            // $table->id();
            $table->boolean('penerima_kps');
            $table->integer('no_kps');
            $table->boolean('penerima_kip');
            $table->integer('no_kip');
            $table->string('nama_kip', 100);
            $table->boolean('layak_pip');
            $table->string('alasan_layak_pip', 100);
            $table->string('nama_bank', 15);
            $table->integer('no_rekening');
            $table->string('nama_rekening', 100);
            $table->integer('no_kks');
            $table->integer('nik_ayah');
            $table->string('nama_ayah');
            $table->integer('tahun_lahir_ayah');
            $table->string('jenjang_pendidikan_ayah', 15);
            $table->integer('pekerjaan_ayah');
            $table->integer('penghasilan_ayah');
            $table->integer('nik_ibu');
            $table->string('nama_ibu');
            $table->integer('tahun_lahir_ibu');
            $table->string('jenjang_pendidikan_ibu', 15);
            $table->integer('pekerjaan_ibu');
            $table->integer('penghasilan_ibu');
            $table->integer('nik_wali');
            $table->string('nama_wali');
            $table->integer('tahun_lahir_wali');
            $table->string('jenjang_pendidikan_wali', 15);
            $table->integer('pekerjaan_wali');
            $table->integer('penghasilan_wali');
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
