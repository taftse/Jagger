<?php

namespace App\Models;

use Database\Factories\StaticMetadataFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaticMetadata extends Model
{
    /** @use HasFactory<StaticMetadataFactory> */
    use HasFactory;

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
