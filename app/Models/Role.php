<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory, HasUuids;

    protected $table = 'acl_role';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'description',
        'parent_id',
    ];

    public function acls(): HasMany
    {
        return $this->hasMany(Acl::class, 'role_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Role::class, 'parent_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'aclrole_members', 'role_id', 'user_id');
    }
}
