<?php

namespace App\Models;

use Database\Factories\AirportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airport extends Model
{
    /** @use HasFactory<AirportFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'city',
        'province',
        'code',
    ];

    /**
     * @return HasMany<Flight, $this>
     */
    public function outboundFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_airport_id');
    }

    /**
     * @return HasMany<Flight, $this>
     */
    public function inboundFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_airport_id');
    }
}
