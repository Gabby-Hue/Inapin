<?php

namespace Tests\Feature;

use App\Models\{Airport, Booking, Ferry, Flight, Partner, Port, Property, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class InapinMvpTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_login(): void
    {
        $this->post('/register', [
            'name' => 'Wisatawan', 'email' => 'user@example.com', 'password' => 'password123', 'password_confirmation' => 'password123',
        ])->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        auth()->logout();

        $this->post('/login', ['email' => 'user@example.com', 'password' => 'password123'])->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_partner_property_is_hidden_until_admin_approves_it(): void
    {
        $partnerUser = User::create(['name' => 'Partner', 'email' => 'partner@example.com', 'password' => Hash::make('password'), 'role' => 'partner']);
        Partner::create(['user_id' => $partnerUser->id, 'business_name' => 'Lokal Stay', 'verification_status' => 'approved']);

        $this->actingAs($partnerUser)->post('/partner/properties', $this->propertyPayload())->assertRedirect('/partner/properties');
        $property = Property::first();
        $this->assertSame('pending', $property->status);
        $this->get('/properties')->assertDontSee('Villa Test');

        $admin = User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role' => 'admin']);
        $this->actingAs($admin)->put("/admin/properties/{$property->id}", ['status' => 'approved'])->assertRedirect();
        $this->get('/properties')->assertSee('Villa Test');
    }

    public function test_search_transport_and_recommend_destination_properties(): void
    {
        $property = $this->approvedProperty('Bali');
        $cgk = Airport::create(['name' => 'Soekarno Hatta', 'city' => 'Jakarta', 'code' => 'CGK']);
        $dps = Airport::create(['name' => 'Ngurah Rai', 'city' => 'Bali', 'code' => 'DPS']);
        $flight = Flight::create(['airline' => 'Garuda Test', 'origin_airport_id' => $cgk->id, 'destination_airport_id' => $dps->id, 'departure_time' => now(), 'arrival_time' => now()->addHours(2), 'price' => 1000000]);
        $origin = Port::create(['name' => 'Tanjung Priok', 'city' => 'Jakarta']);
        $destination = Port::create(['name' => 'Benoa', 'city' => 'Bali']);
        $ferry = Ferry::create(['operator' => 'Pelni Test', 'origin_port_id' => $origin->id, 'destination_port_id' => $destination->id, 'departure_time' => now(), 'arrival_time' => now()->addDay(), 'price' => 300000]);

        $this->get('/flights/search?origin=Jakarta&destination=Bali')->assertOk()->assertSee('Garuda Test');
        $this->get("/flights/{$flight->id}")->assertOk()->assertSee($property->name);
        $this->get('/ferries/search?origin=Jakarta&destination=Bali')->assertOk()->assertSee('Pelni Test');
        $this->get("/ferries/{$ferry->id}")->assertOk()->assertSee($property->name);
    }

    public function test_booking_rules_and_review_average_rating(): void
    {
        $property = $this->approvedProperty('Bali', capacity: 2);
        $user = User::create(['name' => 'User', 'email' => 'booker@example.com', 'password' => Hash::make('password'), 'role' => 'user']);

        $this->actingAs($user)->post('/bookings', ['property_id' => $property->id, 'check_in' => '2026-07-01', 'check_out' => '2026-07-03', 'guest_count' => 3])->assertStatus(422);
        $this->actingAs($user)->post('/bookings', ['property_id' => $property->id, 'check_in' => '2026-07-01', 'check_out' => '2026-07-03', 'guest_count' => 2])->assertRedirect();
        $booking = Booking::first();
        $this->assertSame('pending', $booking->status);
        $this->assertSame(1000000, $booking->total_price);

        $this->actingAs($user)->post('/reviews', ['booking_id' => $booking->id, 'rating' => 5])->assertForbidden();
        $booking->update(['status' => 'completed']);
        $this->actingAs($user)->post('/reviews', ['booking_id' => $booking->id, 'rating' => 5, 'comment' => 'Mantap'])->assertRedirect();
        $this->assertSame(5.0, $property->fresh()->average_rating);
    }

    private function propertyPayload(): array
    {
        return ['name' => 'Villa Test', 'description' => 'Villa nyaman', 'category' => 'Villa', 'city' => 'Bali', 'address' => 'Ubud', 'price_per_night' => 500000, 'capacity' => 2, 'facilities' => 'wifi,pool'];
    }

    private function approvedProperty(string $city, int $capacity = 4): Property
    {
        $partnerUser = User::create(['name' => Str::random(8), 'email' => Str::random(8).'@example.com', 'password' => Hash::make('password'), 'role' => 'partner']);
        $partner = Partner::create(['user_id' => $partnerUser->id, 'business_name' => 'Stay '.$city, 'verification_status' => 'approved']);
        $payload = array_merge($this->propertyPayload(), ['partner_id' => $partner->id, 'slug' => Str::slug($city).'-'.Str::random(6), 'city' => $city, 'capacity' => $capacity, 'status' => 'approved']);
        $payload['facilities'] = ['wifi', 'pool'];
        return Property::create($payload);
    }
}
