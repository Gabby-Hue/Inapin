<?php

namespace App\Services\Property;

final readonly class PropertySearchCriteria
{
    public function __construct(
        public ?string $destination = null,
        public ?string $category = null,
        public ?int $guestCount = null,
        public ?int $minimumPrice = null,
        public ?int $maximumPrice = null,
    ) {}
}
