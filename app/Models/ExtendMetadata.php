<?php

namespace App\Models;

use Database\Factories\ExtendMetadataFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExtendMetadata extends Model
{
    /** @use HasFactory<ExtendMetadataFactory> */
    use HasFactory;

    protected $table = 'extend_metadata';

    public $timestamps = false;

    protected $fillable = [
        'etype',
        'provider_id',
        'namespace',
        'parent_id',
        'element',
        'evalue',
        'attrs',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ExtendMetadata::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ExtendMetadata::class, 'parent_id');
    }
}
