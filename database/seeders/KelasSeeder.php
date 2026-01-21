<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = ['1A', '1B'];

        foreach ($kelasList as $nama) {
            Kelas::create([
                'nama_kelas' => $nama,
                'id_pegawai' => null
            ]);
        }
    }
}
