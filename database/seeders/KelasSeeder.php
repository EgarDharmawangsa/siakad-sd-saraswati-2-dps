<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = ['1A', '1B', '2A', '2B', '3A', '3B', '4A', '4B', '5A', '5B', '6A', '6B'];

        foreach ($kelasList as $nama) {
            Kelas::create([
                'nama_kelas' => $nama,
                'id_pegawai' => null
            ]);
        }
    }
}
