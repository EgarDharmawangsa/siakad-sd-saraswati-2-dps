<?php

namespace Database\Seeders;

use App\Models\Kehadiran;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KehadiranSeeder extends Seeder
{
    public function run(): void
    {
        $kehadiranData = [];

        $semesterId = 4; // Asumsi semester aktif = 1
        $tanggalMulai = Carbon::parse('2026-01-20'); // tanggal awal absensi
        $statusOptions = ['Hadir', 'Izin', 'Sakit', 'Alfa'];

        // 10 siswa, 5 siswa per kelas
        $siswaKelas1 = [1, 2, 3, 4, 5]; // id_siswa
        $siswaKelas2 = [6, 7, 8, 9, 10];

        // Generate kehadiran untuk 5 hari
        for ($i = 0; $i < 5; $i++) {
            $tanggal = $tanggalMulai->copy()->addDays($i)->toDateString();

            // Kehadiran siswa kelas 1
            foreach ($siswaKelas1 as $siswaId) {
                $status = $statusOptions[array_rand($statusOptions)];
                $keterangan = match($status) {
                    'Hadir' => null,
                    'Izin' => 'Izin karena ada urusan keluarga',
                    'Sakit' => 'Sakit demam',
                    'Alfa' => 'Tidak hadir tanpa keterangan',
                };
                $kehadiranData[] = [
                    'id_siswa' => $siswaId,
                    'id_semester' => $semesterId,
                    'status' => $status,
                    'keterangan' => $keterangan,
                    'tanggal' => $tanggal,
                ];
            }

            // Kehadiran siswa kelas 2
            foreach ($siswaKelas2 as $siswaId) {
                $status = $statusOptions[array_rand($statusOptions)];
                $keterangan = match($status) {
                    'Hadir' => null,
                    'Izin' => 'Izin karena ada kegiatan keluarga',
                    'Sakit' => 'Sakit flu',
                    'Alfa' => 'Tidak hadir tanpa izin',
                };
                $kehadiranData[] = [
                    'id_siswa' => $siswaId,
                    'id_semester' => $semesterId,
                    'status' => $status,
                    'keterangan' => $keterangan,
                    'tanggal' => $tanggal,
                ];
            }
        }

        foreach ($kehadiranData as $data) {
            Kehadiran::create($data);
        }
    }
}
