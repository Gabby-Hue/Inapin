<?php

use App\Enums\BookingStatus;
use App\Enums\PartnerStatus;
use App\Enums\PropertyStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('business_name');
            $table->text('business_description')->nullable();
            $table->enum('status', PartnerStatus::values())->default(PartnerStatus::PENDING->value)->index();
            $table->string('contact_phone', 30)->nullable();
            $table->string('tax_identification_number', 50)->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('city')->index();
            $table->string('province')->index();
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category', 50)->index();
            $table->string('city')->index();
            $table->string('province')->index();
            $table->string('address');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('price_per_night');
            $table->unsignedSmallInteger('capacity');
            $table->unsignedTinyInteger('bedroom_count')->default(1);
            $table->unsignedTinyInteger('bathroom_count')->default(1);
            $table->json('facilities')->nullable();
            $table->enum('status', PropertyStatus::values())->default(PropertyStatus::PENDING->value)->index();
            $table->timestamps();

            $table->index(['city', 'status']);
            $table->index(['province', 'status']);
        });

        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->index(['property_id', 'sort_order']);
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedSmallInteger('guest_count');
            $table->unsignedInteger('total_price');
            $table->enum('status', BookingStatus::values())->default(BookingStatus::PENDING->value)->index();
            $table->string('guest_name');
            $table->string('guest_phone', 30)->nullable();
            $table->text('special_requests')->nullable();
            $table->timestamps();

            $table->index(['property_id', 'check_in', 'check_out']);
            $table->index(['user_id', 'status']);
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->index(['property_id', 'rating']);
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();

            $table->unique(['user_id', 'property_id']);
        });

        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city')->index();
            $table->string('province')->index();
            $table->string('code', 3)->unique();
            $table->timestamps();
        });

        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('flight_number', 20)->nullable()->index();
            $table->foreignId('origin_airport_id')->constrained('airports')->cascadeOnDelete();
            $table->foreignId('destination_airport_id')->constrained('airports')->cascadeOnDelete();
            $table->dateTime('departure_time')->index();
            $table->dateTime('arrival_time');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->index(['origin_airport_id', 'destination_airport_id', 'departure_time'], 'flights_route_departure_index');
        });

        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city')->index();
            $table->string('province')->index();
            $table->string('code', 10)->unique();
            $table->timestamps();
        });

        Schema::create('ferries', function (Blueprint $table) {
            $table->id();
            $table->string('operator');
            $table->string('vessel_name')->nullable();
            $table->foreignId('origin_port_id')->constrained('ports')->cascadeOnDelete();
            $table->foreignId('destination_port_id')->constrained('ports')->cascadeOnDelete();
            $table->dateTime('departure_time')->index();
            $table->dateTime('arrival_time');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->index(['origin_port_id', 'destination_port_id', 'departure_time'], 'ferries_route_departure_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ferries');
        Schema::dropIfExists('ports');
        Schema::dropIfExists('flights');
        Schema::dropIfExists('airports');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('property_images');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('partners');
    }
};
