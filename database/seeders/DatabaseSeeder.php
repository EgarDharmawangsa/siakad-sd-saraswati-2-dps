<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use App\Models\MataPelajaran;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Pengumuman;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Pegawai::create([
            'nik' => '3273010101010001',
            'nip' => '198765432100000001',
            'nipppk' => '0',
            'nama_pegawai' => 'Admin Pegawai',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Islam',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Contoh No. 1, Bandung',
            'no_telepon_rumah' => '0211234567',
            'no_telepon_seluler' => '081234567890',
            'e_mail' => 'pegawai@example.com',
            'jabatan' => 'Penata Muda | III/a',
            'status_perkawinan' => 'Belum',
            'status_kepegawaian' => 'PNS',
            'ijazah_terakhir' => 'S1',
            'tahun_ijazah' => 2012,
            'posisi' => 'Staf Tata Usaha',
            'status_sertifikasi' => 'Sudah',
            'tahun_sertifikasi' => 2018,
            'permulaan_kerja' => '2020-07-01',
            'permulaan_kerja_sds2' => '2020-07-15',
            'no_sk' => 'SK-001/2020',
            'tanggal_sk_terakhir' => '2024-01-10',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'id_pegawai' => 1,
            'username' => 'pegawaiadmin',
            'password' => bcrypt('pegawai123'),
            'role' => 'Staf Tata Usaha'
        ]);

        MataPelajaran::factory(30)->create();

        Ekstrakurikuler::factory(30)->create();

        Pengumuman::factory(30)->create();
    }
}
