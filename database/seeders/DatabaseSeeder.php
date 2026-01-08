<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use App\Models\MataPelajaran;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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

        Siswa::factory(5)->create();

        User::create([
            'id_pegawai' => 1,
            'username' => 'pegawaiadmin',
            'password' => bcrypt('pegawai123'),
            // 'id_pegawai' => $pegawai->id_pegawai, 
            // 'username' => 'admin',
            // 'password' => bcrypt('admin'), 
            'role' => 'Staf Tata Usaha'
        ]);

        MataPelajaran::factory(30)->create();
        Ekstrakurikuler::factory(30)->create();
        Pengumuman::factory(30)->create();
    }
}