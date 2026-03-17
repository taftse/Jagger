<?php

namespace App\Models;

use Database\Factories\AttributeReleasePolicyFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeReleasePolicy extends Model
{
    /** @use HasFactory<AttributeReleasePolicyFactory> */
    use HasFactory, HasUuids;

    protected $table = 'attribute_release_policy';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'attribute_id',
        'provider_id',
        'requester_id',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    /**
     * The optional Service Provider that this policy is scoped to.
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'requester_id');
    }
}
