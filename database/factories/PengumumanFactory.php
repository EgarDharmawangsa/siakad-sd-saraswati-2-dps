<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengumuman>
 */
class PengumumanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(2),
            'tanggal' => Carbon::parse($this->faker->dateTimeBetween('-1 month', '+1 month')),
            'isi' => '<div><strong>' . $this->faker->sentence(6) . '</strong> ' . $this->faker->paragraph(2) . '</div>',
            'gambar' => null,
        ];
    }
}
