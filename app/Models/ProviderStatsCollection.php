<?php

namespace App\Models;

use Database\Factories\ProviderStatsCollectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderStatsCollection extends Model
{
    /** @use HasFactory<ProviderStatsCollectionFactory> */
    use HasFactory;

    protected $table = 'providerstatscollection';

    public $timestamps = false;

    protected $fillable = [
        'provider_id',
        'statdefinition_id',
        'format',
        'statfilename',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function statDefinition(): BelongsTo
    {
        return $this->belongsTo(ProviderStatsDef::class, 'statdefinition_id');
    }
}
