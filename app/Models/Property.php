<?php

namespace App\Models;

use App\Enums\PropertyStatus;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<PropertyFactory> */
    use HasFactory;

    public const CATEGORIES = ['Hotel', 'Resort', 'Villa', 'Homestay', 'Guest House', 'Cottage', 'Glamping'];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'partner_id',
        'name',
        'slug',
        'description',
        'category',
        'city',
        'province',
        'address',
        'latitude',
        'longitude',
        'price_per_night',
        'capacity',
        'bedroom_count',
        'bathroom_count',
        'facilities',
        'status',
    ];

    /**
     * @return BelongsTo<Partner, $this>
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * @return HasMany<PropertyImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }

    /**
     * @return HasMany<Booking, $this>
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return HasMany<Review, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return HasMany<Favorite, $this>
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withPivot('created_at');
    }

    public function getAverageRatingAttribute(): ?float
    {
        $average = $this->reviews()->avg('rating');

        return $average === null ? null : round((float) $average, 1);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'price_per_night' => 'integer',
            'status' => PropertyStatus::class,
        ];
    }
}
