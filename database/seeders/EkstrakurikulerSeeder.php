<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $ekstrakurikuler = [
            [
                'nama_ekstrakurikuler' => 'Pramuka',
                'nama_pembina' => 'I Made Suardika',
                'alamat_pembina' => 'Jl. Nusa Indah No. 10, Denpasar',
                'no_telepon' => '081234567890',
                'hari' => 'Sabtu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'nama_ekstrakurikuler' => 'Tari Bali',
                'nama_pembina' => 'Ni Wayan Sukarini',
                'alamat_pembina' => 'Jl. Tukad Badung No. 5, Denpasar',
                'no_telepon' => '081345678901',
                'hari' => 'Rabu',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'nama_ekstrakurikuler' => 'Gamelan',
                'nama_pembina' => 'I Ketut Sudiana',
                'alamat_pembina' => 'Jl. Puputan No. 20, Denpasar',
                'no_telepon' => '081456789012',
                'hari' => 'Kamis',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'nama_ekstrakurikuler' => 'Sepak Bola',
                'nama_pembina' => 'I Nyoman Arta',
                'alamat_pembina' => 'Jl. Diponegoro No. 15, Denpasar',
                'no_telepon' => '081567890123',
                'hari' => 'Selasa',
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00'
            ],
            [
                'nama_ekstrakurikuler' => 'Pencak Silat',
                'nama_pembina' => 'I Gede Putra',
                'alamat_pembina' => 'Jl. Gatot Subroto No. 8, Denpasar',
                'no_telepon' => '081678901234',
                'hari' => 'Jumat',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'nama_ekstrakurikuler' => 'Menggambar',
                'nama_pembina' => 'Ni Luh Ayu Dewi',
                'alamat_pembina' => 'Jl. Teuku Umar No. 25, Denpasar',
                'no_telepon' => '081789012345',
                'hari' => 'Senin',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
        ];

        foreach ($ekstrakurikuler as $ekskul) {
            Ekstrakurikuler::create($ekskul);
        }
    }
}
