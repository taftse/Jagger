<?php

namespace App\Models;

use Database\Factories\CodeOfConductFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Represents a Code of Conduct (CoC) entry that can be associated with providers.
 * Used to track compliance frameworks (e.g., GÉANT Code of Conduct, entity categories).
 */
class CodeOfConduct extends Model
{
    /** @use HasFactory<CodeOfConductFactory> */
    use HasFactory, HasUuids;

    protected $table = 'coc';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'subtype',
        'url',
        'cdescription',
        'is_enabled',
        'lang',
        'availfor',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
        ];
    }

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class, 'Provider_Coc', 'coc_id', 'provider_id');
    }
}
