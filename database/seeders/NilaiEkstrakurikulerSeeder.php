<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesertaEkstrakurikuler;
use App\Models\Semester;
use App\Models\NilaiEkstrakurikuler;

class NilaiEkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $semesterIds = Semester::pluck('id_semester')->toArray(); 
        $pesertaIds = PesertaEkstrakurikuler::pluck('id_peserta_ekstrakurikuler')->toArray(); 

        foreach ($pesertaIds as $idPeserta) {
            foreach ($semesterIds as $idSemester) {
                NilaiEkstrakurikuler::create([
                    'id_semester' => $idSemester,
                    'id_peserta_ekstrakurikuler' => $idPeserta,
                    'nilai' => rand(60, 100), 
                ]);
            }
        }
    }
}
