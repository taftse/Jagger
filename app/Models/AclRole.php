<?php

namespace App\Models;

use Database\Factories\AclRoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AclRole extends Model
{
    /** @use HasFactory<AclRoleFactory> */
    use HasFactory;

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
        return $this->belongsTo(AclRole::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(AclRole::class, 'parent_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'aclrole_members', 'role_id', 'user_id');
    }
}
