<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use App\Models\MataPelajaran;
use App\Models\User;
use App\Models\Pengumuman;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        MataPelajaran::factory(30)->create();

        Ekstrakurikuler::factory(30)->create();

        Pengumuman::factory(30)->create();
    }
}
