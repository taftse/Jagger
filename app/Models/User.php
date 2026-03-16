<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'salt',
        'email',
        'givenname',
        'surname',
        'userpref',
        'local',
        'federated',
        'approved',
        'enabled',
        'validated',
        'lastlogin',
        'lastip',
    ];

    protected $hidden = [
        'password',
        'salt',
    ];

    protected function casts(): array
    {
        return [
            'local' => 'boolean',
            'federated' => 'boolean',
            'approved' => 'boolean',
            'enabled' => 'boolean',
            'validated' => 'boolean',
            'lastlogin' => 'datetime',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(AclRole::class, 'aclrole_members', 'user_id', 'role_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(NotificationList::class, 'subscriber');
    }

    public function queueEntries(): HasMany
    {
        return $this->hasMany(JaggerQueue::class, 'creator');
    }
}
