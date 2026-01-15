<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $semesters = [
            [
                'jenis' => 'Ganjil',
                'tanggal_mulai' => '2024-07-15',
                'tanggal_selesai' => '2024-12-20'
            ],
            [
                'jenis' => 'Genap',
                'tanggal_mulai' => '2025-01-06',
                'tanggal_selesai' => '2025-06-20'
            ],
            [
                'jenis' => 'Ganjil',
                'tanggal_mulai' => '2025-07-14',
                'tanggal_selesai' => '2025-12-19'
            ],
            [
                'jenis' => 'Genap',
                'tanggal_mulai' => '2026-01-05',
                'tanggal_selesai' => '2026-06-19'
            ],
        ];

        foreach ($semesters as $semester) {
            Semester::create($semester);
        }
    }
}
