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
            $table->foreignId('id_kelas')->nullable()->constrained('kelas', 'id_kelas')->onDelete('set null');
            $table->integer('nomor_urut')->nullable();
            $table->string('no_kk', 16);
            $table->string('nik', 16)->unique();
            $table->string('nisn', 10)->unique();
            $table->string('nipd', 15)->unique()->nullable(); 
            $table->string('nama_siswa');
            $table->string('jenis_kelamin', 10); 
            $table->double('berat_badan')->nullable();
            $table->double('tinggi_badan')->nullable();
            $table->double('lingkar_kepala')->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();
            $table->integer('anak_ke_berapa')->nullable();
            $table->string('agama', 20);
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->string('no_registrasi_akta_lahir', 50)->nullable()->unique();
            $table->text('alamat'); 
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('dusun', 25)->nullable();
            $table->string('kelurahan', 25)->nullable();
            $table->string('kecamatan', 25)->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->string('lintang', 10)->nullable();
            $table->string('bujur', 10)->nullable();
            $table->double('jarak_rumah_ke_sekolah')->nullable();
            $table->string('jenis_tinggal', 20);
            $table->string('alat_transportasi', 25);
            $table->string('no_telepon_rumah', 15)->nullable();
            $table->string('no_telepon_seluler', 15);
            $table->string('e_mail')->unique()->nullable();
            $table->string('disabilitas', 20); 
            $table->string('keterangan_disabilitas', 100)->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('no_peserta_un', 25)->nullable();
            $table->string('no_seri_ijazah', 30)->nullable()->unique();
            $table->string('penerima_kps', 5); 
            $table->string('no_kps', 13)->unique()->nullable();
            $table->string('penerima_kip', 5);
            $table->string('no_kip', 13)->unique()->nullable();
            $table->string('nama_kip')->nullable();
            $table->string('layak_pip', 5);
            $table->string('alasan_layak_pip')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening', 25)->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('no_kks', 16)->nullable()->unique();
            $table->string('nik_ayah', 16)->unique()->nullable();
            $table->string('nama_ayah')->nullable();
            $table->integer('tahun_lahir_ayah')->nullable();
            $table->string('jenjang_pendidikan_ayah', 50)->nullable(); 
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->string('penghasilan_ayah', 20)->nullable(); 
            $table->string('nik_ibu', 16)->unique()->nullable();
            $table->string('nama_ibu')->nullable();
            $table->integer('tahun_lahir_ibu')->nullable();
            $table->string('jenjang_pendidikan_ibu', 50)->nullable();
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->string('penghasilan_ibu', 20)->nullable();
            $table->string('nik_wali', 16)->unique()->nullable();
            $table->string('nama_wali')->nullable();
            $table->integer('tahun_lahir_wali')->nullable();
            $table->string('jenjang_pendidikan_wali', 50)->nullable();
            $table->string('pekerjaan_wali', 100)->nullable();
            $table->string('penghasilan_wali', 20)->nullable();
            $table->string('foto')->nullable(); 
            $table->timestamps();
            $table->string('skhun')->nullable();
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