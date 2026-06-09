<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'city', 'code'])]
class Airport extends Model
{
    use HasFactory;
    public function outboundFlights() { return $this->hasMany(Flight::class, 'origin_airport_id'); }
    public function inboundFlights() { return $this->hasMany(Flight::class, 'destination_airport_id'); }
}
