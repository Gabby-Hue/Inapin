<?php

namespace Database\Factories;

use App\Models\Port;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Port>
 */
class PortFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->randomElement(['Jakarta', 'Surabaya', 'Denpasar', 'Lombok', 'Batam', 'Makassar']);

        return [
            'name' => 'Pelabuhan '.fake()->randomElement(['Tanjung Priok', 'Tanjung Perak', 'Benoa', 'Lembar', 'Sekupang', 'Soekarno-Hatta']),
            'city' => $city,
            'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Bali', 'Nusa Tenggara Barat', 'Kepulauan Riau', 'Sulawesi Selatan']),
            'code' => fake()->unique()->bothify('ID-???'),
        ];
    }
}
