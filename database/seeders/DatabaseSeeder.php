<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Urutan seeder penting karena ada relasi antar tabel:
     * 1. Semester - tidak ada dependency
     * 2. MataPelajaran - tidak ada dependency
     * 3. Ekstrakurikuler - tidak ada dependency  
     * 4. Pegawai - tidak ada dependency, tapi membuat User & GuruMataPelajaran
     * 5. Kelas - perlu id_pegawai (opsional)
     * 6. Siswa - perlu id_kelas, membuat User
     * 7. Pengumuman - tidak ada dependency
     */
    public function run(): void
    {
        $this->call([
            SemesterSeeder::class,
            MataPelajaranSeeder::class,
            EkstrakurikulerSeeder::class,
            KelasSeeder::class,
            PegawaiSeeder::class,
            SiswaSeeder::class,
            PesertaEkstrakurikulerSeeder::class,
            PrestasiSeeder::class,
            JadwalPelajaranSeeder::class,
            KehadiranSeeder::class,
            NilaiMataPelajaranSeeder::class,
            NilaiEkstrakurikulerSeeder::class,
            PengumumanSeeder::class
        ]);
    }
}