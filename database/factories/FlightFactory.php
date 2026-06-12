<?php

namespace Database\Factories;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    public function definition(): array
    {
        $departure = fake()->dateTimeBetween('+1 day', '+2 months');
        $arrival = (clone $departure)->modify('+'.fake()->numberBetween(1, 3).' hours');

        return [
            'airline' => fake()->randomElement(['Garuda Indonesia', 'Batik Air', 'Citilink', 'Super Air Jet', 'Lion Air']),
            'flight_number' => fake()->bothify('??-###'),
            'origin_airport_id' => Airport::factory(),
            'destination_airport_id' => Airport::factory(),
            'departure_time' => $departure,
            'arrival_time' => $arrival,
            'price' => fake()->numberBetween(650000, 2500000),
        ];
    }
}
