<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $booking = Booking::factory()->completed()->create();

        return [
            'booking_id' => $booking->id,
            'property_id' => $booking->property_id,
            'user_id' => $booking->user_id,
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake('id_ID')->paragraph(),
        ];
    }
}
