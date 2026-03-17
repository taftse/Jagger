<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

/**
 * Pivot model for the many-to-many relationship between Federation and Provider.
 * Tracks the join state, disabled and banned status of each member.
 */
class FederationMember extends MorphPivot
{
    protected $table = 'federation_members';

    public $timestamps = false;

    protected $fillable = [
        'provider_id',
        'federation_id',
        'join_state',
        'is_disabled',
        'is_banned',
    ];

    protected function casts(): array
    {
        return [
            'join_state' => 'integer',
            'is_disabled' => 'boolean',
            'is_banned' => 'boolean',
        ];
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
