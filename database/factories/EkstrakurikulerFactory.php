<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ekstrakurikuler>
 */
class EkstrakurikulerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_ekstrakurikuler' => $this->faker->unique()->words(2, true),
            'nama_pembina' => $this->faker->name(),
            'alamat_pembina' => $this->faker->address(),
            'no_telepon' => $this->faker->numerify('08##########'),
            'hari' => $this->faker->numberBetween(1, 7), 
            'jam_mulai' => $this->faker->time('H:i'),
            'jam_selesai' => $this->faker->time('H:i'),
        ];
    }
}
