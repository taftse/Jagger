<?php

namespace App\Models;

use Database\Factories\ProviderStatsDefFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderStatsDef extends Model
{
    /** @use HasFactory<ProviderStatsDefFactory> */
    use HasFactory, HasUuids;

    protected $table = 'providerstatsdef';

    protected $fillable = [
        'short_name',
        'title_name',
        'provider_id',
        'type',
        'predefined_col',
        'method',
        'format_type',
        'source_url',
        'access_type',
        'auth_user',
        'auth_pass',
        'display_options',
        'post_options',
        'description',
        'overwrite',
    ];

    protected function casts(): array
    {
        return [
            'overwrite' => 'boolean',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function statsCollections(): HasMany
    {
        return $this->hasMany(ProviderStatsCollection::class, 'stats_def_id');
    }
}
