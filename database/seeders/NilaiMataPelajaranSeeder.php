<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\NilaiMataPelajaran;

class NilaiMataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $kelasIds = [1, 2];
        $semesterIds = [1, 2, 3, 4];
        $mataPelajaranIds = range(1, 12);

        foreach ($kelasIds as $idKelas) {

            $siswaKelas = Siswa::where('id_kelas', $idKelas)->get();

            foreach ($mataPelajaranIds as $idMapel) {
                foreach ($semesterIds as $idSemester) {

                    // ✅ JUMLAH PORTOFOLIO SAMA UNTUK 1 KELAS + MAPEL + SEMESTER
                    $jumlahPorto = rand(1, 3);

                    // template portofolio
                    $templatePortofolio = [];
                    for ($i = 1; $i <= $jumlahPorto; $i++) {
                        $templatePortofolio[] = [
                            'judul' => "Portofolio $i",
                        ];
                    }

                    foreach ($siswaKelas as $siswa) {

                        // clone + isi nilai
                        $nilaiPortofolio = collect($templatePortofolio)
                            ->map(fn ($porto) => [
                                ...$porto,
                                'nilai' => rand(60, 100),
                            ])
                            ->toArray();

                        NilaiMataPelajaran::create([
                            'id_siswa' => $siswa->id_siswa,
                            'id_mata_pelajaran' => $idMapel,
                            'id_semester' => $idSemester,
                            'jumlah_portofolio' => $jumlahPorto,
                            'nilai_portofolio' => $nilaiPortofolio,
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
