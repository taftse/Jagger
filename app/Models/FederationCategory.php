<?php

namespace App\Models;

use Database\Factories\FederationCategoryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FederationCategory extends Model
{
    /** @use HasFactory<FederationCategoryFactory> */
    use HasFactory, HasUuids;

    protected $table = 'fedcategory';

    public $timestamps = false;

    protected $fillable = [
        'short_name',
        'desc_name',
        'description',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    public function federations(): BelongsToMany
    {
        return $this->belongsToMany(Federation::class, 'fedcategory_members', 'fedcategory_id', 'federation_id');
    }
}
