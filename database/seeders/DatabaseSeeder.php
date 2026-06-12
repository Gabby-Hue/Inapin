<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\PartnerStatus;
use App\Enums\PropertyStatus;
use App\Enums\UserRole;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Favorite;
use App\Models\Ferry;
use App\Models\Flight;
use App\Models\Partner;
use App\Models\Port;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@inapin.test'],
            ['name' => 'Admin Inapin', 'password' => Hash::make('password'), 'role' => UserRole::ADMIN->value, 'phone' => '+62 811-0000-0001']
        );

        $travellers = collect([
            ['name' => 'Ayu Lestari', 'email' => 'ayu@inapin.test', 'phone' => '+62 812-3456-7890'],
            ['name' => 'Budi Santoso', 'email' => 'budi@inapin.test', 'phone' => '+62 813-2222-3333'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@inapin.test', 'phone' => '+62 821-5555-7777'],
        ])->map(fn (array $traveller) => User::firstOrCreate(
            ['email' => $traveller['email']],
            ['name' => $traveller['name'], 'password' => Hash::make('password'), 'role' => UserRole::USER->value, 'phone' => $traveller['phone']]
        ));

        $partners = collect([
            [
                'user' => ['name' => 'Made Wijaya', 'email' => 'partner.bali@inapin.test', 'phone' => '+62 361-700-100'],
                'business_name' => 'Ubud Sawah Hospitality',
                'business_description' => 'Pengelola villa dan homestay bernuansa sawah di Gianyar dan Ubud.',
                'city' => 'Ubud',
                'province' => 'Bali',
                'address' => 'Jl. Raya Tegallalang No. 18, Ubud',
            ],
            [
                'user' => ['name' => 'Rina Prameswari', 'email' => 'partner.jogja@inapin.test', 'phone' => '+62 274-888-200'],
                'business_name' => 'Jogja Heritage Stay',
                'business_description' => 'Akomodasi keluarga dekat Malioboro, Keraton, dan sentra gudeg Wijilan.',
                'city' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'address' => 'Jl. Prawirotaman II No. 45, Yogyakarta',
            ],
            [
                'user' => ['name' => 'Muhammad Ardi', 'email' => 'partner.lombok@inapin.test', 'phone' => '+62 370-640-300'],
                'business_name' => 'Lombok Mandalika Retreat',
                'business_description' => 'Penginapan pantai di sekitar Kuta Mandalika dan Senggigi.',
                'city' => 'Lombok Tengah',
                'province' => 'Nusa Tenggara Barat',
                'address' => 'Jl. Pariwisata Kuta Mandalika No. 9, Lombok Tengah',
            ],
        ])->map(function (array $partnerData): Partner {
            $user = User::firstOrCreate(
                ['email' => $partnerData['user']['email']],
                [
                    'name' => $partnerData['user']['name'],
                    'password' => Hash::make('password'),
                    'role' => UserRole::PARTNER->value,
                    'phone' => $partnerData['user']['phone'],
                ]
            );

            return Partner::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'business_name' => $partnerData['business_name'],
                    'business_description' => $partnerData['business_description'],
                    'status' => PartnerStatus::APPROVED,
                    'contact_phone' => $partnerData['user']['phone'],
                    'tax_identification_number' => fake()->unique()->numerify('##.###.###.#-###.###'),
                    'address' => $partnerData['address'],
                    'city' => $partnerData['city'],
                    'province' => $partnerData['province'],
                ]
            );
        });

        $propertyRows = [
            ['partner' => 0, 'name' => 'Villa Sawah Tegallalang', 'category' => 'Villa', 'city' => 'Ubud', 'province' => 'Bali', 'address' => 'Jl. Raya Tegallalang, Ubud, Gianyar', 'price' => 1250000, 'capacity' => 4, 'bedrooms' => 2, 'bathrooms' => 2, 'facilities' => ['wifi', 'pool', 'breakfast', 'rice_field_view', 'parking']],
            ['partner' => 0, 'name' => 'Canggu Sunset Guest House', 'category' => 'Guest House', 'city' => 'Canggu', 'province' => 'Bali', 'address' => 'Jl. Pantai Batu Bolong No. 88, Canggu', 'price' => 650000, 'capacity' => 2, 'bedrooms' => 1, 'bathrooms' => 1, 'facilities' => ['wifi', 'ac', 'shared_kitchen', 'parking']],
            ['partner' => 1, 'name' => 'Malioboro Heritage Homestay', 'category' => 'Homestay', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Sosrowijayan No. 12, Gedong Tengen', 'price' => 420000, 'capacity' => 3, 'bedrooms' => 1, 'bathrooms' => 1, 'facilities' => ['wifi', 'ac', 'breakfast', 'family_room']],
            ['partner' => 1, 'name' => 'Prawirotaman Boutique Cottage', 'category' => 'Cottage', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Prawirotaman No. 28, Mergangsan', 'price' => 780000, 'capacity' => 4, 'bedrooms' => 2, 'bathrooms' => 2, 'facilities' => ['wifi', 'pool', 'breakfast', 'garden']],
            ['partner' => 2, 'name' => 'Mandalika Ocean Resort', 'category' => 'Resort', 'city' => 'Lombok Tengah', 'province' => 'Nusa Tenggara Barat', 'address' => 'Jl. Pariwisata Pantai Kuta, Mandalika', 'price' => 1450000, 'capacity' => 4, 'bedrooms' => 2, 'bathrooms' => 2, 'facilities' => ['wifi', 'pool', 'sea_view', 'breakfast', 'airport_transfer']],
        ];

        $properties = collect($propertyRows)->map(function (array $row) use ($partners): Property {
            return Property::firstOrCreate(
                ['slug' => Str::slug($row['name'])],
                [
                    'partner_id' => $partners[$row['partner']]->id,
                    'name' => $row['name'],
                    'description' => "Akomodasi pilihan Inapin di {$row['city']} dengan layanan ramah, lokasi strategis, dan fasilitas nyaman untuk perjalanan domestik Indonesia.",
                    'category' => $row['category'],
                    'city' => $row['city'],
                    'province' => $row['province'],
                    'address' => $row['address'],
                    'latitude' => fake()->latitude(-8.8, -6.0),
                    'longitude' => fake()->longitude(106.0, 120.0),
                    'price_per_night' => $row['price'],
                    'capacity' => $row['capacity'],
                    'bedroom_count' => $row['bedrooms'],
                    'bathroom_count' => $row['bathrooms'],
                    'facilities' => $row['facilities'],
                    'status' => PropertyStatus::APPROVED,
                ]
            );
        });

        $properties->each(function (Property $property): void {
            foreach (range(1, 3) as $index) {
                PropertyImage::firstOrCreate(
                    ['property_id' => $property->id, 'sort_order' => $index - 1],
                    [
                        'image_path' => 'properties/'.Str::slug($property->name).'-'.$index.'.jpg',
                        'alt_text' => $property->name.' foto '.$index,
                        'is_primary' => $index === 1,
                    ]
                );
            }
        });

        $booking = Booking::firstOrCreate(
            ['property_id' => $properties[0]->id, 'user_id' => $travellers[0]->id, 'check_in' => now()->addDays(14)->toDateString()],
            [
                'check_out' => now()->addDays(17)->toDateString(),
                'guest_count' => 2,
                'total_price' => 3750000,
                'status' => BookingStatus::CONFIRMED,
                'guest_name' => $travellers[0]->name,
                'guest_phone' => $travellers[0]->phone,
                'special_requests' => 'Mohon kamar dengan pemandangan sawah.',
            ]
        );

        Review::firstOrCreate(
            ['booking_id' => $booking->id],
            ['property_id' => $booking->property_id, 'user_id' => $booking->user_id, 'rating' => 5, 'comment' => 'Tempat bersih, host ramah, dan cocok untuk liburan keluarga di Bali.']
        );

        $travellers->each(fn (User $user, int $index) => Favorite::firstOrCreate(['user_id' => $user->id, 'property_id' => $properties[$index % $properties->count()]->id]));

        $airports = collect([
            ['code' => 'CGK', 'name' => 'Soekarno-Hatta International Airport', 'city' => 'Tangerang', 'province' => 'Banten'],
            ['code' => 'DPS', 'name' => 'I Gusti Ngurah Rai International Airport', 'city' => 'Denpasar', 'province' => 'Bali'],
            ['code' => 'YIA', 'name' => 'Yogyakarta International Airport', 'city' => 'Kulon Progo', 'province' => 'DI Yogyakarta'],
            ['code' => 'LOP', 'name' => 'Zainuddin Abdul Madjid International Airport', 'city' => 'Lombok Tengah', 'province' => 'Nusa Tenggara Barat'],
        ])->map(fn (array $airport) => Airport::firstOrCreate(['code' => $airport['code']], $airport));

        foreach ([[0, 1, 'Garuda Indonesia', 'GA-402', 950000], [0, 2, 'Batik Air', 'ID-6368', 780000], [0, 3, 'Super Air Jet', 'IU-768', 1120000], [2, 1, 'Citilink', 'QG-780', 890000]] as $i => [$origin, $destination, $airline, $flightNumber, $price]) {
            Flight::firstOrCreate(
                ['flight_number' => $flightNumber, 'departure_time' => now()->addDays($i + 3)->setTime(8 + $i, 30)],
                [
                    'airline' => $airline,
                    'origin_airport_id' => $airports[$origin]->id,
                    'destination_airport_id' => $airports[$destination]->id,
                    'arrival_time' => now()->addDays($i + 3)->setTime(10 + $i, 15),
                    'price' => $price,
                ]
            );
        }

        $ports = collect([
            ['code' => 'ID-TPK', 'name' => 'Pelabuhan Tanjung Priok', 'city' => 'Jakarta', 'province' => 'DKI Jakarta'],
            ['code' => 'ID-BNO', 'name' => 'Pelabuhan Benoa', 'city' => 'Denpasar', 'province' => 'Bali'],
            ['code' => 'ID-LBR', 'name' => 'Pelabuhan Lembar', 'city' => 'Lombok Barat', 'province' => 'Nusa Tenggara Barat'],
            ['code' => 'ID-TPE', 'name' => 'Pelabuhan Tanjung Perak', 'city' => 'Surabaya', 'province' => 'Jawa Timur'],
        ])->map(fn (array $port) => Port::firstOrCreate(['code' => $port['code']], $port));

        foreach ([[0, 1, 'PELNI', 'KM Kelud', 375000], [3, 1, 'Dharma Lautan Utama', 'KM Dharma Rucitra', 260000], [1, 2, 'ASDP Indonesia Ferry', 'KMP Nusa Jaya', 75000]] as $i => [$origin, $destination, $operator, $vessel, $price]) {
            Ferry::firstOrCreate(
                ['vessel_name' => $vessel, 'departure_time' => now()->addDays($i + 4)->setTime(14, 0)],
                [
                    'operator' => $operator,
                    'origin_port_id' => $ports[$origin]->id,
                    'destination_port_id' => $ports[$destination]->id,
                    'arrival_time' => now()->addDays($i + 5)->setTime(7, 0),
                    'price' => $price,
                ]
            );
        }

        $admin->touch();
    }
}
