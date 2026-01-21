<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $prestasiData = [
            [
                'nama_prestasi' => 'Lomba Matematika SD',
                'penyelenggara' => 'Dinas Pendidikan Bali',
                'id_siswa' => 1,
                'jenis' => 'Akademik',
                'peringkat' => '1 (Pertama)',
                'peringkat_lainnya' => null,
                'tingkat' => 'Kecamatan',
                'wilayah' => 'Denpasar Barat',
                'tanggal_peraihan' => '2026-01-10',
                'dokumentasi' => null,
            ],
            [
                'nama_prestasi' => 'Lomba Membaca Puisi',
                'penyelenggara' => 'Sekolah',
                'id_siswa' => 2,
                'jenis' => 'Non-Akademik',
                'peringkat' => '2 (Kedua)',
                'peringkat_lainnya' => null,
                'tingkat' => 'Sekolah',
                'wilayah' => 'Denpasar',
                'tanggal_peraihan' => '2025-02-15',
                'dokumentasi' => null,
            ],
            [
                'nama_prestasi' => 'Lomba IPA',
                'penyelenggara' => 'Kecamatan Denpasar Barat',
                'id_siswa' => 3,
                'jenis' => 'Akademik',
                'peringkat' => '3 (Ketiga)',
                'peringkat_lainnya' => null,
                'tingkat' => 'Kecamatan',
                'wilayah' => 'Denpasar Barat',
                'tanggal_peraihan' => '2026-03-20',
                'dokumentasi' => null,
            ],
            [
                'nama_prestasi' => 'Lomba Tari Bali',
                'penyelenggara' => 'Dinas Kebudayaan',
                'id_siswa' => 4,
                'jenis' => 'Non-Akademik',
                'peringkat' => 'Harapan 1',
                'peringkat_lainnya' => null,
                'tingkat' => 'Kabupaten/Kota',
                'wilayah' => 'Badung',
                'tanggal_peraihan' => '2026-04-05',
                'dokumentasi' => null,
            ],
            [
                'nama_prestasi' => 'Juara Cerdas Cermat',
                'penyelenggara' => 'Provinsi Bali',
                'id_siswa' => 5,
                'jenis' => 'Akademik',
                'peringkat' => 'Harapan 2',
                'peringkat_lainnya' => null,
                'tingkat' => 'Provinsi',
                'wilayah' => 'Bali',
                'tanggal_peraihan' => '2025-05-12',
                'dokumentasi' => null,
            ],
            [
                'nama_prestasi' => 'Lomba Bola Voli',
                'penyelenggara' => 'Sekolah',
                'id_siswa' => 6,
                'jenis' => 'Non-Akademik',
                'peringkat' => '1 (Pertama)',
                'peringkat_lainnya' => null,
                'tingkat' => 'Sekolah',
                'wilayah' => 'Bangli',
                'tanggal_peraihan' => '2025-06-18',
                'dokumentasi' => null,
            ],
            [
                'nama_prestasi' => 'Lomba Karya Ilmiah',
                'penyelenggara' => 'Nasional',
                'id_siswa' => 7,
                'jenis' => 'Akademik',
                'peringkat' => 'Lainnya',
                'peringkat_lainnya' => 'Juara Favorit',
                'tingkat' => 'Nasional',
                'wilayah' => 'Indonesia',
                'tanggal_peraihan' => '2026-07-22',
                'dokumentasi' => null,
            ],
        ];

        foreach ($prestasiData as $data) {
            Prestasi::create($data);
        }
    }
}
