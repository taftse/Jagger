<?php

namespace App\Models;

use Database\Factories\NotificationListFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationList extends Model
{
    /** @use HasFactory<NotificationListFactory> */
    use HasFactory;

    protected $table = 'notificationlist';

    public $timestamps = false;

    protected $fillable = [
        'subscriber',
        'notificationtype',
        'type',
        'provider',
        'federation',
        'email',
        'phone',
        'isenabled',
        'isapproved',
        'created',
        'updated',
    ];

    protected function casts(): array
    {
        return [
            'isenabled' => 'boolean',
            'isapproved' => 'boolean',
            'created' => 'datetime',
            'updated' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'subscriber');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider');
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'federation');
    }
}
