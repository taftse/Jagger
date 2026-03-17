<?php

namespace App\Models;

use Database\Factories\ProviderStatsCollectionFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderStatsCollection extends Model
{
    /** @use HasFactory<ProviderStatsCollectionFactory> */
    use HasFactory, HasUuids;

    protected $table = 'providerstatscollection';

    protected $fillable = [
        'provider_id',
        'stats_def_id',
        'format',
        'stat_filename',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function statDefinition(): BelongsTo
    {
        return $this->belongsTo(ProviderStatsDef::class, 'stats_def_id');
    }
}
