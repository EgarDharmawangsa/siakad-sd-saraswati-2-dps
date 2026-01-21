<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\NilaiMataPelajaran;
use Illuminate\Support\Arr;

class NilaiMataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $kelasIds = [1, 2]; // ID kelas
        $semesterIds = [1, 2, 3, 4]; // 4 semester
        $mataPelajaranIds = range(1, 12); // 12 mata pelajaran

        foreach ($kelasIds as $idKelas) {
            $siswaKelas = Siswa::where('id_kelas', $idKelas)->get();

            foreach ($siswaKelas as $siswa) {
                foreach ($mataPelajaranIds as $idMapel) {
                    foreach ($semesterIds as $idSemester) {
                        // Jumlah portofolio random (misal 1-3)
                        $jumlahPorto = rand(1, 3);
                        $nilaiPortofolio = [];

                        for ($i = 1; $i <= $jumlahPorto; $i++) {
                            $nilaiPortofolio[] = [
                                'judul' => "Portofolio $i",
                                'nilai' => rand(60, 100), // nilai random
                            ];
                        }

                        NilaiMataPelajaran::create([
                            'id_siswa' => $siswa->id_siswa,
                            'id_mata_pelajaran' => $idMapel,
                            'id_semester' => $idSemester,
                            'jumlah_portofolio' => $jumlahPorto,
                            'nilai_portofolio' => $nilaiPortofolio, // Laravel akan otomatis encode JSON
                            'nilai_ub_1' => rand(60, 100),
                            'nilai_ub_2' => rand(60, 100),
                            'nilai_uts' => rand(60, 100),
                            'nilai_uas' => rand(60, 100),
                        ]);
                    }
                }
            }
        }
    }
}
