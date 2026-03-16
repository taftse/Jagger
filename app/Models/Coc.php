<?php

namespace App\Models;

use Database\Factories\CocFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coc extends Model
{
    /** @use HasFactory<CocFactory> */
    use HasFactory;

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
