<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyImage>
 */
class PropertyImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'property_id' => Property::factory()->approved(),
            'image_path' => 'properties/demo-'.fake()->numberBetween(1, 12).'.jpg',
            'alt_text' => fake('id_ID')->sentence(4),
            'sort_order' => fake()->numberBetween(0, 5),
            'is_primary' => false,
        ];
    }

    public function primary(): static
    {
        return $this->state(fn (array $attributes) => ['sort_order' => 0, 'is_primary' => true]);
    }
}
