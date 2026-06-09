<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['airline', 'origin_airport_id', 'destination_airport_id', 'departure_time', 'arrival_time', 'price'])]
class Flight extends Model
{
    use HasFactory;
    protected function casts(): array { return ['departure_time' => 'datetime', 'arrival_time' => 'datetime']; }
    public function originAirport() { return $this->belongsTo(Airport::class, 'origin_airport_id'); }
    public function destinationAirport() { return $this->belongsTo(Airport::class, 'destination_airport_id'); }
}
