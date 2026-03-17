<?php

namespace App\Models;

use Database\Factories\MetadataFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Stores the static/cached XML metadata for a Provider.
 */
class Metadata extends Model
{
    /** @use HasFactory<MetadataFactory> */
    use HasFactory, HasUuids;

    protected $table = 'provider_metadata';

    public $timestamps = false;

    protected $fillable = [
        'metadata',
        'provider_id',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
