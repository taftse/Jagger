<?php

namespace App\Models;

use Database\Factories\ProviderStatsDefFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderStatsDef extends Model
{
    /** @use HasFactory<ProviderStatsDefFactory> */
    use HasFactory;

    protected $table = 'providerstatsdef';

    protected $fillable = [
        'shortname',
        'titlename',
        'provider_id',
        'type',
        'predefinedcol',
        'method',
        'formattype',
        'sourceurl',
        'accesstype',
        'authuser',
        'authpass',
        'displayoptions',
        'postoptions',
        'description',
        'overwrite',
    ];

    protected function casts(): array
    {
        return [
            'overwrite' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function statsCollection(): HasMany
    {
        return $this->hasMany(ProviderStatsCollection::class, 'statdefinition_id');
    }
}
