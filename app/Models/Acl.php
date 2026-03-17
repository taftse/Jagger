<?php

namespace App\Models;

use Database\Factories\AclFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Acl extends Model
{
    /** @use HasFactory<AclFactory> */
    use HasFactory, HasUuids;

    protected $table = 'acl';

    public $timestamps = false;

    protected $fillable = [
        'resource_id',
        'role_id',
        'action',
        'access',
    ];

    protected function casts(): array
    {
        return [
            'resource_id' => 'string',
            'role_id' => 'string',
            'action' => 'string',
            'access' => 'boolean',
        ];
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(AclResource::class, 'resource_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
