<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['property_id', 'image_path'])]
class PropertyImage extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';

    public function property() { return $this->belongsTo(Property::class); }
}
