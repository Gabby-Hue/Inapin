<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('+1 week', '+3 months');
        $checkOut = (clone $checkIn)->modify('+'.fake()->numberBetween(1, 5).' days');

        return [
            'property_id' => Property::factory()->approved(),
            'user_id' => User::factory(),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guest_count' => fake()->numberBetween(1, 4),
            'total_price' => fake()->numberBetween(500000, 8000000),
            'status' => fake()->randomElement(BookingStatus::cases()),
            'guest_name' => fake('id_ID')->name(),
            'guest_phone' => fake('id_ID')->phoneNumber(),
            'special_requests' => fake('id_ID')->optional()->sentence(),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => ['status' => BookingStatus::COMPLETED]);
    }
}
