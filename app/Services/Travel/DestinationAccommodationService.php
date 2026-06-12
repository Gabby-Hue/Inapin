<?php

namespace App\Services\Travel;

use App\Services\Property\PropertyDiscoveryService;
use App\Services\Property\PropertySearchCriteria;
use Illuminate\Database\Eloquent\Collection;

class DestinationAccommodationService
{
    public function __construct(private readonly PropertyDiscoveryService $properties) {}

    /**
     * @return Collection<int, \App\Models\Property>
     */
    public function recommendedForDestination(string $city, int $limit = 6): Collection
    {
        return $this->properties
            ->approvedSearch(new PropertySearchCriteria(destination: $city))
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->limit($limit)
            ->get();
    }
}
