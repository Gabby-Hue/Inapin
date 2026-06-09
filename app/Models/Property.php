<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['partner_id', 'name', 'slug', 'description', 'category', 'city', 'address', 'price_per_night', 'capacity', 'facilities', 'status'])]
class Property extends Model
{
    use HasFactory;

    public const CATEGORIES = ['Resort', 'Villa', 'Homestay', 'Guest House', 'Cottage', 'Glamping'];

    protected function casts(): array
    {
        return ['facilities' => 'array'];
    }

    public function partner() { return $this->belongsTo(Partner::class); }
    public function bookings() { return $this->hasMany(Booking::class); }
    public function reviews() { return $this->hasMany(Review::class); }
    public function images() { return $this->hasMany(PropertyImage::class); }

    public function getAverageRatingAttribute(): ?float
    {
        $average = $this->reviews()->avg('rating');
        return $average === null ? null : round((float) $average, 1);
    }
}
