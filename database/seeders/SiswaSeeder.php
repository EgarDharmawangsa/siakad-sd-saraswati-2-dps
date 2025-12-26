<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::factory(50)->create()->each(function ($siswa) {
            
            $siswa->userAuth()->create([
                'username' => $siswa->nisn, 
                'password' => Hash::make('password'),
                'role'     => 'siswa'
            ]);
            
        });
    }
}