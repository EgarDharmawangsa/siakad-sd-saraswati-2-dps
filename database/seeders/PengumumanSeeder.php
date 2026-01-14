<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $pengumuman = [
            [
                'judul' => 'Penerimaan Rapor Semester Ganjil',
                'isi' => 'Penerimaan rapor semester ganjil tahun ajaran 2024/2025 akan dilaksanakan pada hari Jumat, 20 Desember 2024. Orang tua/wali murid diharapkan hadir untuk mengambil rapor putra-putrinya.',
                'tanggal' => '2024-12-15',
                'gambar' => null
            ],
            [
                'judul' => 'Libur Semester Ganjil',
                'isi' => 'Libur semester ganjil akan berlangsung mulai tanggal 23 Desember 2024 sampai dengan 5 Januari 2025. Kegiatan belajar mengajar akan dimulai kembali pada tanggal 6 Januari 2025.',
                'tanggal' => '2024-12-18',
                'gambar' => null
            ],
            [
                'judul' => 'Pendaftaran Ekstrakurikuler',
                'isi' => 'Pendaftaran kegiatan ekstrakurikuler untuk semester genap 2024/2025 dibuka mulai tanggal 6-10 Januari 2025. Siswa dapat mendaftar maksimal 2 kegiatan ekstrakurikuler.',
                'tanggal' => '2025-01-02',
                'gambar' => null
            ],
            [
                'judul' => 'Jadwal UTS Semester Genap',
                'isi' => 'Ujian Tengah Semester (UTS) semester genap akan dilaksanakan pada tanggal 10-14 Maret 2025. Materi ujian mencakup semua pelajaran yang telah dipelajari dari awal semester.',
                'tanggal' => '2025-02-28',
                'gambar' => null
            ],
            [
                'judul' => 'Peringatan Hari Nyepi',
                'isi' => 'Dalam rangka peringatan Hari Raya Nyepi Tahun Baru Saka 1947, sekolah akan libur pada tanggal 29 Maret 2025. Kegiatan belajar mengajar akan dimulai kembali pada tanggal 31 Maret 2025.',
                'tanggal' => '2025-03-25',
                'gambar' => null
            ],
        ];

        foreach ($pengumuman as $data) {
            Pengumuman::create($data);
        }
    }
}
