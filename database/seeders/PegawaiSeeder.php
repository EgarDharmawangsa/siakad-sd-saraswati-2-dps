<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\GuruMataPelajaran;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Staf TU
        $admin = Pegawai::create([
            'nik' => '5171010101900001',
            'nip' => '198501012010011001',
            'nipppk' => null,
            'nama_pegawai' => 'I Made Sudirman',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1985-01-01',
            'alamat' => 'Jl. Gatot Subroto No. 10, Denpasar',
            'no_telepon_rumah' => '0361234567',
            'no_telepon_seluler' => '081234567890',
            'e_mail' => 'admin@sdsaraswati2.sch.id',
            'jabatan' => 'Penata Muda | III/a',
            'status_perkawinan' => 'Sudah',
            'status_kepegawaian' => 'PNS',
            'ijazah_terakhir' => 'S1',
            'tahun_ijazah' => 2008,
            'posisi' => 'Staf Tata Usaha',
            'status_sertifikasi' => 'Sudah',
            'tahun_sertifikasi' => 2015,
            'permulaan_kerja' => '2010-01-01',
            'permulaan_kerja_sds2' => '2010-01-15',
            'no_sk' => 'SK-001/2010',
            'tanggal_sk_terakhir' => '2020-01-10',
            'foto' => null
        ]);

        User::create([
            'id_pegawai' => $admin->id_pegawai,
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'Staf Tata Usaha'
        ]);

        // 2. Guru Kelas 1A - I Wayan Sudiarta (Matematika, IPA)
        $guru1 = Pegawai::create([
            'nik' => '5171020203880002',
            'nip' => '198802022012011002',
            'nipppk' => null,
            'nama_pegawai' => 'I Wayan Sudiarta',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Gianyar',
            'tanggal_lahir' => '1988-02-02',
            'alamat' => 'Jl. Raya Ubud No. 25, Gianyar',
            'no_telepon_rumah' => null,
            'no_telepon_seluler' => '082345678901',
            'e_mail' => 'sudiarta@sdsaraswati2.sch.id',
            'jabatan' => 'Penata Muda Tk. I | III/b',
            'status_perkawinan' => 'Sudah',
            'status_kepegawaian' => 'PNS',
            'ijazah_terakhir' => 'S1',
            'tahun_ijazah' => 2010,
            'posisi' => 'Guru',
            'status_sertifikasi' => 'Sudah',
            'tahun_sertifikasi' => 2018,
            'permulaan_kerja' => '2012-01-01',
            'permulaan_kerja_sds2' => '2012-01-15',
            'no_sk' => 'SK-002/2012',
            'tanggal_sk_terakhir' => '2022-01-10',
            'foto' => null
        ]);

        User::create([
            'id_pegawai' => $guru1->id_pegawai,
            'username' => 'sudiarta',
            'password' => bcrypt('guru123'),
            'role' => 'Guru'
        ]);

        // Guru Mata Pelajaran untuk Guru 1
        GuruMataPelajaran::create(['id_pegawai' => $guru1->id_pegawai, 'id_mata_pelajaran' => 4]); // Matematika
        GuruMataPelajaran::create(['id_pegawai' => $guru1->id_pegawai, 'id_mata_pelajaran' => 5]); // IPA

        // 3. Guru Kelas 2A - Ni Made Suartini (Bahasa Indonesia, Bahasa Bali)
        $guru2 = Pegawai::create([
            'nik' => '5171030304900003',
            'nip' => '199003032015012003',
            'nipppk' => null,
            'nama_pegawai' => 'Ni Made Suartini',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Tabanan',
            'tanggal_lahir' => '1990-03-03',
            'alamat' => 'Jl. Raya Tabanan No. 15, Tabanan',
            'no_telepon_rumah' => null,
            'no_telepon_seluler' => '083456789012',
            'e_mail' => 'suartini@sdsaraswati2.sch.id',
            'jabatan' => 'Penata Muda | III/a',
            'status_perkawinan' => 'Sudah',
            'status_kepegawaian' => 'PNS',
            'ijazah_terakhir' => 'S1',
            'tahun_ijazah' => 2012,
            'posisi' => 'Guru',
            'status_sertifikasi' => 'Sudah',
            'tahun_sertifikasi' => 2020,
            'permulaan_kerja' => '2015-01-01',
            'permulaan_kerja_sds2' => '2015-01-15',
            'no_sk' => 'SK-003/2015',
            'tanggal_sk_terakhir' => '2023-01-10',
            'foto' => null
        ]);

        User::create([
            'id_pegawai' => $guru2->id_pegawai,
            'username' => 'suartini',
            'password' => bcrypt('guru123'),
            'role' => 'Guru'
        ]);

        // Guru Mata Pelajaran untuk Guru 2
        GuruMataPelajaran::create(['id_pegawai' => $guru2->id_pegawai, 'id_mata_pelajaran' => 3]); // Bahasa Indonesia
        GuruMataPelajaran::create(['id_pegawai' => $guru2->id_pegawai, 'id_mata_pelajaran' => 10]); // Bahasa Bali

        // 4. Guru PJOK
        $guruPjok = Pegawai::create([
            'nik' => '5171040405920004',
            'nip' => '199204042018011004',
            'nipppk' => null,
            'nama_pegawai' => 'I Ketut Wirawan',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Badung',
            'tanggal_lahir' => '1992-04-04',
            'alamat' => 'Jl. Sunset Road No. 50, Badung',
            'no_telepon_rumah' => null,
            'no_telepon_seluler' => '084567890123',
            'e_mail' => 'wirawan@sdsaraswati2.sch.id',
            'jabatan' => 'Pengatur Tk. I | II/d',
            'status_perkawinan' => 'Belum',
            'status_kepegawaian' => 'PNS',
            'ijazah_terakhir' => 'S1',
            'tahun_ijazah' => 2014,
            'posisi' => 'Guru',
            'status_sertifikasi' => 'Sudah',
            'tahun_sertifikasi' => 2022,
            'permulaan_kerja' => '2018-01-01',
            'permulaan_kerja_sds2' => '2018-01-15',
            'no_sk' => 'SK-004/2018',
            'tanggal_sk_terakhir' => '2024-01-10',
            'foto' => null
        ]);

        User::create([
            'id_pegawai' => $guruPjok->id_pegawai,
            'username' => 'wirawan',
            'password' => bcrypt('guru123'),
            'role' => 'Guru'
        ]);

        GuruMataPelajaran::create(['id_pegawai' => $guruPjok->id_pegawai, 'id_mata_pelajaran' => 8]); // PJOK

        // 5. Pegawai Perpustakaan
        Pegawai::create([
            'nik' => '5171050506950005',
            'nip' => null,
            'nipppk' => null,
            'nama_pegawai' => 'Ni Nyoman Sari',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1995-05-05',
            'alamat' => 'Jl. Teuku Umar No. 30, Denpasar',
            'no_telepon_rumah' => null,
            'no_telepon_seluler' => '085678901234',
            'e_mail' => 'sari@sdsaraswati2.sch.id',
            'jabatan' => null,
            'status_perkawinan' => 'Belum',
            'status_kepegawaian' => 'Honorer',
            'ijazah_terakhir' => 'SMA',
            'tahun_ijazah' => 2013,
            'posisi' => 'Pegawai Perpustakaan',
            'status_sertifikasi' => 'Belum',
            'tahun_sertifikasi' => null,
            'permulaan_kerja' => '2020-07-01',
            'permulaan_kerja_sds2' => '2020-07-15',
            'no_sk' => null,
            'tanggal_sk_terakhir' => null,
            'foto' => null
        ]);

        // 6. Satuan Pengamanan
        Pegawai::create([
            'nik' => '5171060607800006',
            'nip' => null,
            'nipppk' => null,
            'nama_pegawai' => 'I Gede Artawan',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Klungkung',
            'tanggal_lahir' => '1980-06-06',
            'alamat' => 'Jl. Nusa Penida No. 5, Klungkung',
            'no_telepon_rumah' => null,
            'no_telepon_seluler' => '086789012345',
            'e_mail' => null,
            'jabatan' => null,
            'status_perkawinan' => 'Sudah',
            'status_kepegawaian' => 'Kontrak',
            'ijazah_terakhir' => 'SMA',
            'tahun_ijazah' => 1999,
            'posisi' => 'Satuan Pengamananan',
            'status_sertifikasi' => 'Belum',
            'tahun_sertifikasi' => null,
            'permulaan_kerja' => '2015-01-01',
            'permulaan_kerja_sds2' => '2015-01-15',
            'no_sk' => null,
            'tanggal_sk_terakhir' => null,
            'foto' => null
        ]);

        // 7. Pegawai Kebersihan
        Pegawai::create([
            'nik' => '5171070708750007',
            'nip' => null,
            'nipppk' => null,
            'nama_pegawai' => 'I Wayan Sudana',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Hindu',
            'tempat_lahir' => 'Karangasem',
            'tanggal_lahir' => '1975-07-07',
            'alamat' => 'Jl. Raya Candidasa No. 10, Karangasem',
            'no_telepon_rumah' => null,
            'no_telepon_seluler' => '087890123456',
            'e_mail' => null,
            'jabatan' => null,
            'status_perkawinan' => 'Sudah',
            'status_kepegawaian' => 'Kontrak',
            'ijazah_terakhir' => 'SMP',
            'tahun_ijazah' => 1990,
            'posisi' => 'Pegawai Kebersihan',
            'status_sertifikasi' => 'Belum',
            'tahun_sertifikasi' => null,
            'permulaan_kerja' => '2010-01-01',
            'permulaan_kerja_sds2' => '2010-01-15',
            'no_sk' => null,
            'tanggal_sk_terakhir' => null,
            'foto' => null
        ]);
    }
}
