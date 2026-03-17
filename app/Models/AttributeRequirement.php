<?php

namespace App\Models;

use App\Enums\AttributeRequirementStatus;
use App\Enums\AttributeRequirementType;
use Database\Factories\AttributeRequirementFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeRequirement extends Model
{
    /** @use HasFactory<AttributeRequirementFactory> */
    use HasFactory, HasUuids;

    protected $table = 'attribute_requirement';

    public $timestamps = false;

    protected $fillable = [
        'attribute_id',
        'provider_id',
        'federation_id',
        'type',
        'status',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'type' => AttributeRequirementType::class,
            'status' => AttributeRequirementStatus::class,
        ];
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }
}
