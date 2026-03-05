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
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); 
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();
            $table->integer('anak_ke_berapa')->nullable();
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu']);
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
            $table->decimal('jarak_rumah_ke_sekolah', 5, 2)->nullable();
            $table->enum('jenis_tinggal', ['Bersama Orang Tua', 'Wali', 'Kos', 'Asrama', 'Panti Asuhan', 'Lainnya']);
            $table->enum('alat_transportasi', ['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Angkutan Umum', 'Antar Jemput Sekolah', 'Ojek', 'Lainnya']);
            $table->string('no_telepon_rumah', 15)->nullable();
            $table->string('no_telepon_seluler', 15);
            $table->string('e_mail')->unique()->nullable();
            $table->enum('kebutuhan_khusus', ['Tidak Ada', 'Ada']); 
            $table->string('keterangan_kebutuhan_khusus', 100)->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('no_peserta_un', 25)->nullable();
            $table->string('no_seri_ijazah', 30)->nullable()->unique();
            $table->enum('penerima_kps', ['Ya', 'Tidak']); 
            $table->string('no_kps', 13)->unique()->nullable();
            $table->enum('penerima_kip', ['Ya', 'Tidak']);
            $table->string('no_kip', 13)->unique()->nullable();
            $table->string('nama_kip')->nullable();
            $table->enum('layak_pip', ['Ya', 'Tidak']);
            $table->string('alasan_layak_pip')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening', 25)->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('no_kks', 16)->nullable()->unique();
            $table->string('nik_ayah', 16)->unique()->nullable();
            $table->string('nama_ayah')->nullable();
            $table->integer('tahun_lahir_ayah')->nullable();
            $table->enum('jenjang_pendidikan_ayah', ['Tidak Sekolah', 'TK Sederajat', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'Diploma', 'Sarjana', 'Magister', 'Doktor'])->nullable(); 
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->enum('penghasilan_ayah', ['Kurang Dari 500.000', '500.000 - 999.999', '1jt - 1.999.999', '2jt - 4.999.999', '>= 5jt'])->nullable(); 
            $table->string('nik_ibu', 16)->unique()->nullable();
            $table->string('nama_ibu')->nullable();
            $table->integer('tahun_lahir_ibu')->nullable();
            $table->enum('jenjang_pendidikan_ibu', ['Tidak Sekolah', 'TK Sederajat', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'Diploma', 'Sarjana', 'Magister', 'Doktor'])->nullable(); 
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->enum('penghasilan_ibu', ['Kurang Dari 500.000', '500.000 - 999.999', '1jt - 1.999.999', '2jt - 4.999.999', '>= 5jt'])->nullable();
            $table->string('nik_wali', 16)->unique()->nullable();
            $table->string('nama_wali')->nullable();
            $table->integer('tahun_lahir_wali')->nullable();
            $table->enum('jenjang_pendidikan_wali', ['Tidak Sekolah', 'TK Sederajat', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'Diploma', 'Sarjana', 'Magister', 'Doktor'])->nullable();
            $table->string('pekerjaan_wali', 100)->nullable();
            $table->enum('penghasilan_wali', ['Kurang Dari 500.000', '500.000 - 999.999', '1jt - 1.999.999', '2jt - 4.999.999', '>= 5jt'])->nullable();
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