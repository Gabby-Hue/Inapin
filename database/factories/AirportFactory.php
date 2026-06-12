<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Airport>
 */
class AirportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Soekarno-Hatta', 'I Gusti Ngurah Rai', 'Juanda', 'Sultan Hasanuddin']).' International Airport',
            'city' => fake()->randomElement(['Jakarta', 'Denpasar', 'Surabaya', 'Makassar']),
            'province' => fake()->randomElement(['DKI Jakarta', 'Bali', 'Jawa Timur', 'Sulawesi Selatan']),
            'code' => fake()->unique()->lexify('???'),
        ];
    }
}
