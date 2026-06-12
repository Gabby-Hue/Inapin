<?php

namespace Database\Factories;

use App\Enums\PropertyStatus;
use App\Models\Partner;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->randomElement(['Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya', 'Denpasar', 'Ubud', 'Lombok', 'Labuan Bajo']);
        $province = match ($city) {
            'Jakarta' => 'DKI Jakarta',
            'Bandung' => 'Jawa Barat',
            'Yogyakarta' => 'DI Yogyakarta',
            'Surabaya' => 'Jawa Timur',
            'Denpasar', 'Ubud' => 'Bali',
            'Lombok' => 'Nusa Tenggara Barat',
            default => 'Nusa Tenggara Timur',
        };
        $name = fake()->randomElement(['Villa', 'Homestay', 'Guest House', 'Resort', 'Cottage']).' '.fake('id_ID')->citySuffix().' '.fake()->unique()->word();

        return [
            'partner_id' => Partner::factory()->approved(),
            'name' => Str::title($name),
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(6)),
            'description' => fake('id_ID')->paragraphs(2, true),
            'category' => fake()->randomElement(Property::CATEGORIES),
            'city' => $city,
            'province' => $province,
            'address' => fake('id_ID')->streetAddress(),
            'latitude' => fake()->latitude(-8.8, -6.0),
            'longitude' => fake()->longitude(106.0, 120.0),
            'price_per_night' => fake()->numberBetween(250000, 2500000),
            'capacity' => fake()->numberBetween(1, 8),
            'bedroom_count' => fake()->numberBetween(1, 4),
            'bathroom_count' => fake()->numberBetween(1, 3),
            'facilities' => fake()->randomElements(['wifi', 'ac', 'breakfast', 'pool', 'parking', 'kitchen', 'sea_view'], fake()->numberBetween(3, 6)),
            'status' => fake()->randomElement(PropertyStatus::cases()),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => ['status' => PropertyStatus::APPROVED]);
    }
}
