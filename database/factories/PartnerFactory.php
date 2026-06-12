<?php

namespace Database\Factories;

use App\Enums\PartnerStatus;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partner>
 */
class PartnerFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->randomElement(['Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya', 'Denpasar', 'Lombok', 'Makassar']);
        $province = match ($city) {
            'Jakarta' => 'DKI Jakarta',
            'Bandung' => 'Jawa Barat',
            'Yogyakarta' => 'DI Yogyakarta',
            'Surabaya' => 'Jawa Timur',
            'Denpasar' => 'Bali',
            'Lombok' => 'Nusa Tenggara Barat',
            default => 'Sulawesi Selatan',
        };

        return [
            'user_id' => User::factory()->partner(),
            'business_name' => fake('id_ID')->company().' Hospitality',
            'business_description' => fake('id_ID')->paragraph(),
            'status' => fake()->randomElement(PartnerStatus::cases()),
            'contact_phone' => fake('id_ID')->phoneNumber(),
            'tax_identification_number' => fake()->unique()->numerify('##.###.###.#-###.###'),
            'address' => fake('id_ID')->streetAddress(),
            'city' => $city,
            'province' => $province,
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => ['status' => PartnerStatus::APPROVED]);
    }
}
