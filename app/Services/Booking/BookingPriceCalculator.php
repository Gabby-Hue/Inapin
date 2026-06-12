<?php

namespace App\Services\Booking;

use App\Models\Property;
use Carbon\CarbonInterface;

class BookingPriceCalculator
{
    public function calculate(Property $property, CarbonInterface $checkIn, CarbonInterface $checkOut): int
    {
        $nights = max(1, $checkIn->diffInDays($checkOut));

        return (int) $property->price_per_night * $nights;
    }
}
