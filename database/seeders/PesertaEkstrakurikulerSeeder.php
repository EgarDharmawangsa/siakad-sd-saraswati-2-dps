<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesertaEkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua siswa dan ekstrakurikuler
        $siswaIds = \App\Models\Siswa::pluck('id_siswa')->take(10)->toArray();
        $ekstraIds = \App\Models\Ekstrakurikuler::pluck('id_ekstrakurikuler')->take(10)->toArray();

        $data = [];

        foreach ($siswaIds as $siswaId) {
            // Setiap siswa akan ikut 1 sampai 5 ekstra secara random
            $jumlahEkstra = rand(1, 5);
            $ekstraDipilih = array_rand(array_flip($ekstraIds), $jumlahEkstra);

            // Pastikan $ekstraDipilih menjadi array
            if (!is_array($ekstraDipilih)) {
                $ekstraDipilih = [$ekstraDipilih];
            }

            foreach ($ekstraDipilih as $ekstraId) {
                $data[] = [
                    'id_siswa' => $siswaId,
                    'id_ekstrakurikuler' => $ekstraId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert ke tabel peserta_ekstrakurikuler
        DB::table('peserta_ekstrakurikuler')->insert($data);
    }
}
