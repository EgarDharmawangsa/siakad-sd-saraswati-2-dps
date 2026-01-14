<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mataPelajaran = [
            'Pendidikan Agama',
            'PKN',
            'Bahasa Indonesia',
            'Matematika',
            'IPA',
            'IPS',
            'Seni Budaya',
            'PJOK',
            'Bahasa Inggris',
            'Bahasa Bali',
            'TIK',
            'Mulok',
        ];

        foreach ($mataPelajaran as $nama) {
            MataPelajaran::create([
                'nama_mata_pelajaran' => $nama
            ]);
        }
    }
}
