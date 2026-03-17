<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasUuids, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'old_password',
        'old_salt',
        'username',
        'given_name',
        'surname',
        'user_pref',
        'is_local',
        'is_federated',
        'is_approved',
        'is_enabled',
        'is_validated',
        'last_login',
        'last_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'old_password',
        'old_salt',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_local' => 'boolean',
            'is_federated' => 'boolean',
            'is_approved' => 'boolean',
            'is_enabled' => 'boolean',
            'is_validated' => 'boolean',
            'last_login' => 'datetime',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'aclrole_members', 'user_id', 'role_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(NotificationList::class, 'user_id');
    }
}
