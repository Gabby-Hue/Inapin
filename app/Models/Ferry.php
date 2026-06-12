<?php

namespace App\Models;

use Database\Factories\FerryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ferry extends Model
{
    /** @use HasFactory<FerryFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'operator',
        'vessel_name',
        'origin_port_id',
        'destination_port_id',
        'departure_time',
        'arrival_time',
        'price',
    ];

    /**
     * @return BelongsTo<Port, $this>
     */
    public function originPort(): BelongsTo
    {
        return $this->belongsTo(Port::class, 'origin_port_id');
    }

    /**
     * @return BelongsTo<Port, $this>
     */
    public function destinationPort(): BelongsTo
    {
        return $this->belongsTo(Port::class, 'destination_port_id');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime',
            'arrival_time' => 'datetime',
            'price' => 'integer',
        ];
    }
}
