<?php

namespace App\Models;

use Database\Factories\AclResourceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AclResource extends Model
{
    /** @use HasFactory<AclResourceFactory> */
    use HasFactory;

    protected $table = 'acl_resource';

    public $timestamps = false;

    protected $fillable = [
        'resource',
        'description',
        'type',
        'parent_id',
        'default_value',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(AclResource::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(AclResource::class, 'parent_id');
    }

    public function acls(): HasMany
    {
        return $this->hasMany(Acl::class, 'resource_id');
    }
}
