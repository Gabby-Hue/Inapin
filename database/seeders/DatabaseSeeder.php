<?php

namespace Database\Seeders;

use App\Models\{Airport, Ferry, Flight, Partner, Port, Property, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@inapin.test'], ['name' => 'Admin Inapin', 'password' => Hash::make('password'), 'role' => 'admin']);
        $partnerUser = User::firstOrCreate(['email' => 'partner@inapin.test'], ['name' => 'Partner Bali', 'password' => Hash::make('password'), 'role' => 'partner']);
        $partner = Partner::firstOrCreate(['user_id' => $partnerUser->id], ['business_name' => 'Bali Local Stay', 'business_description' => 'Penginapan lokal Bali', 'verification_status' => 'approved']);

        Property::firstOrCreate(['slug' => 'villa-ubud-demo'], [
            'partner_id' => $partner->id, 'name' => 'Villa Ubud Demo', 'description' => 'Villa tenang dekat persawahan Ubud.', 'category' => 'Villa',
            'city' => 'Bali', 'address' => 'Ubud, Gianyar', 'price_per_night' => 750000, 'capacity' => 4, 'facilities' => ['wifi', 'pool'], 'status' => 'approved',
        ]);

        $cgk = Airport::firstOrCreate(['code' => 'CGK'], ['name' => 'Soekarno-Hatta International Airport', 'city' => 'Jakarta']);
        $dps = Airport::firstOrCreate(['code' => 'DPS'], ['name' => 'I Gusti Ngurah Rai International Airport', 'city' => 'Bali']);
        Flight::firstOrCreate(['airline' => 'Inapin Air', 'origin_airport_id' => $cgk->id, 'destination_airport_id' => $dps->id], ['departure_time' => now()->addDay(), 'arrival_time' => now()->addDay()->addHours(2), 'price' => 950000]);

        $tanjungPriok = Port::firstOrCreate(['name' => 'Tanjung Priok', 'city' => 'Jakarta']);
        $benoa = Port::firstOrCreate(['name' => 'Benoa', 'city' => 'Bali']);
        Ferry::firstOrCreate(['operator' => 'Inapin Ferry', 'origin_port_id' => $tanjungPriok->id, 'destination_port_id' => $benoa->id], ['departure_time' => now()->addDays(2), 'arrival_time' => now()->addDays(3), 'price' => 350000]);
    }
}
