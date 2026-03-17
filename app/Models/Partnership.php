<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for the many-to-many relationship between Provider and Partner.
 */
class Partnership extends Pivot
{
    protected $table = 'partnership';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'provider_id',
        'partner_id',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
