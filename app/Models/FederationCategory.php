<?php

namespace App\Models;

use Database\Factories\FederationCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FederationCategory extends Model
{
    /** @use HasFactory<FederationCategoryFactory> */
    use HasFactory;

    protected $table = 'fedcategory';

    public $timestamps = false;

    protected $fillable = [
        'shortname',
        'descname',
        'description',
        'isdefault',
    ];

    protected function casts(): array
    {
        return [
            'isdefault' => 'boolean',
        ];
    }

    public function federations(): BelongsToMany
    {
        return $this->belongsToMany(Federation::class, 'fedcategory_members', 'fedcategory_id', 'federation_id');
    }
}
