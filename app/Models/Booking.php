<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['property_id', 'user_id', 'check_in', 'check_out', 'guest_count', 'total_price', 'status'])]
class Booking extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return ['check_in' => 'date', 'check_out' => 'date'];
    }

    public function property() { return $this->belongsTo(Property::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function review() { return $this->hasOne(Review::class); }
}
