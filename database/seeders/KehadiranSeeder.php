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

        $semesterId = 4; 
        $tanggalMulai = Carbon::parse('2026-01-20'); 
        $statusOptions = ['Hadir', 'Izin', 'Sakit', 'Alfa'];

        $siswaKelas1 = [1, 2, 3, 4, 5]; 
        $siswaKelas2 = [6, 7, 8, 9, 10];

        for ($i = 0; $i < 5; $i++) {
            $tanggal = $tanggalMulai->copy()->addDays($i)->toDateString();

            // Kehadiran siswa kelas 1
            foreach ($siswaKelas1 as $siswaId) {
                $status = $statusOptions[array_rand($statusOptions)];
                $keterangan = match($status) {
                    'Hadir' => null,
                    'Izin' => 'Izin karena ada urusan keluarga',
                    'Sakit' => null,
                    'Alfa' => null,
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
                    'Sakit' => null,
                    'Alfa' => null
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
