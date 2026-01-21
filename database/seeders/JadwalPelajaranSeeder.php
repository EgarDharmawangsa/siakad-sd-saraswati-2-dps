<?php

namespace Database\Seeders;

use App\Models\JadwalPelajaran;
use Illuminate\Database\Seeder;

class JadwalPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $jadwalData = [];

        $kelasIds = [1, 2]; // 2 kelas
        $hariList = ['Senin', 'Selasa'];
        $guruIds = [1, 2, 3, 4, 5]; // 5 guru

        foreach ($kelasIds as $kelasId) {
            foreach ($hariList as $hari) {
                for ($i = 1; $i <= 5; $i++) {
                    if ($i == 3) {
                        // Jadwal ke-3 = Istirahat
                        $jadwalData[] = [
                            'id_kelas' => $kelasId,
                            'kegiatan' => 'Istirahat',
                            'id_guru_mata_pelajaran' => null,
                            'hari' => $hari,
                            'jam_mulai' => sprintf('%02d:30', 6 + $i), // Contoh jam mulai
                            'jam_selesai' => sprintf('%02d:00', 7 + $i), // Contoh jam selesai
                        ];
                    } else {
                        // Belajar
                        $guruId = $guruIds[$i - 1]; // ambil guru secara urut
                        $jadwalData[] = [
                            'id_kelas' => $kelasId,
                            'kegiatan' => 'Belajar',
                            'id_guru_mata_pelajaran' => $guruId,
                            'hari' => $hari,
                            'jam_mulai' => sprintf('%02d:30', 6 + $i),
                            'jam_selesai' => sprintf('%02d:30', 7 + $i),
                        ];
                    }
                }
            }
        }

        foreach ($jadwalData as $data) {
            JadwalPelajaran::create($data);
        }
    }
}
