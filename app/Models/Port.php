<?php

namespace App\Models;

use Database\Factories\PortFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Port extends Model
{
    /** @use HasFactory<PortFactory> */
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
     * @return HasMany<Ferry, $this>
     */
    public function outboundFerries(): HasMany
    {
        return $this->hasMany(Ferry::class, 'origin_port_id');
    }

    /**
     * @return HasMany<Ferry, $this>
     */
    public function inboundFerries(): HasMany
    {
        return $this->hasMany(Ferry::class, 'destination_port_id');
    }
}
