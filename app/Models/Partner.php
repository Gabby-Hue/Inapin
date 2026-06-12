<?php

namespace App\Models;

use App\Enums\PartnerStatus;
use Database\Factories\PartnerFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    /** @use HasFactory<PartnerFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'business_name',
        'business_description',
        'status',
        'verification_status',
        'contact_phone',
        'tax_identification_number',
        'address',
        'city',
        'province',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Property, $this>
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Backward-compatible alias for earlier controller/form naming.
     *
     * @return Attribute<PartnerStatus|string|null, PartnerStatus|string|null>
     */
    protected function verificationStatus(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status instanceof PartnerStatus ? $this->status->value : $this->status,
            set: fn (PartnerStatus|string|null $value) => ['status' => $value instanceof PartnerStatus ? $value->value : $value],
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => PartnerStatus::class,
        ];
    }
}
