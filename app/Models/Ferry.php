<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['operator', 'origin_port_id', 'destination_port_id', 'departure_time', 'arrival_time', 'price'])]
class Ferry extends Model
{
    use HasFactory;
    protected function casts(): array { return ['departure_time' => 'datetime', 'arrival_time' => 'datetime']; }
    public function originPort() { return $this->belongsTo(Port::class, 'origin_port_id'); }
    public function destinationPort() { return $this->belongsTo(Port::class, 'destination_port_id'); }
}
