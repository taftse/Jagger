<?php

namespace App\Models;

use App\Enums\ExtendMetadataType;
use Database\Factories\ExtendMetadataFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExtendMetadata extends Model
{
    /** @use HasFactory<ExtendMetadataFactory> */
    use HasFactory, HasUuids;

    protected $table = 'extend_metadata';

    public $timestamps = false;

    protected $fillable = [
        'etype',
        'provider_id',
        'namespace',
        'parent_id',
        'element',
        'evalue',
        'attributes',
    ];

    protected function casts(): array
    {
        return [
            'etype' => ExtendMetadataType::class,
        ];
    }

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
