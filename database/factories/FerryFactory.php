<?php

namespace Database\Factories;

use App\Models\Ferry;
use App\Models\Port;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ferry>
 */
class FerryFactory extends Factory
{
    public function definition(): array
    {
        $departure = fake()->dateTimeBetween('+1 day', '+2 months');
        $arrival = (clone $departure)->modify('+'.fake()->numberBetween(4, 36).' hours');

        return [
            'operator' => fake()->randomElement(['PELNI', 'ASDP Indonesia Ferry', 'Dharma Lautan Utama', 'Prima Vista']),
            'vessel_name' => 'KM '.fake()->lastName(),
            'origin_port_id' => Port::factory(),
            'destination_port_id' => Port::factory(),
            'departure_time' => $departure,
            'arrival_time' => $arrival,
            'price' => fake()->numberBetween(75000, 850000),
        ];
    }
}
