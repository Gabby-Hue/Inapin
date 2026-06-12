<?php

namespace App\Services\Property;

use App\Enums\PropertyStatus;
use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;

class PropertyDiscoveryService
{
    /**
     * @return Builder<Property>
     */
    public function approvedSearch(PropertySearchCriteria $criteria): Builder
    {
        return Property::query()
            ->with(['images', 'partner.user'])
            ->where('status', PropertyStatus::APPROVED)
            ->when($criteria->destination, function (Builder $query, string $destination): void {
                $query->where(function (Builder $nested) use ($destination): void {
                    $nested->where('city', 'like', "%{$destination}%")
                        ->orWhere('province', 'like', "%{$destination}%");
                });
            })
            ->when($criteria->category, fn (Builder $query, string $category) => $query->where('category', $category))
            ->when($criteria->guestCount, fn (Builder $query, int $guestCount) => $query->where('capacity', '>=', $guestCount))
            ->when($criteria->minimumPrice, fn (Builder $query, int $minimumPrice) => $query->where('price_per_night', '>=', $minimumPrice))
            ->when($criteria->maximumPrice, fn (Builder $query, int $maximumPrice) => $query->where('price_per_night', '<=', $maximumPrice));
    }
}
