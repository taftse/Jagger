<?php

namespace App\Models;

use Database\Factories\AttributeRequirementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeRequirement extends Model
{
    /** @use HasFactory<AttributeRequirementFactory> */
    use HasFactory;

    protected $table = 'attribute_requirement';

    public $timestamps = false;

    protected $fillable = [
        'attribute_id',
        'sp_id',
        'fed_id',
        'type',
        'status',
        'reason',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'sp_id');
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'fed_id');
    }
}
