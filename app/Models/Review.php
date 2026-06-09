<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['booking_id', 'property_id', 'user_id', 'rating', 'comment'])]
class Review extends Model
{
    use HasFactory;

    public function booking() { return $this->belongsTo(Booking::class); }
    public function property() { return $this->belongsTo(Property::class); }
    public function user() { return $this->belongsTo(User::class); }
}
