<?php

namespace App\Models;

use Database\Factories\NotificationListFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationList extends Model
{
    /** @use HasFactory<NotificationListFactory> */
    use HasFactory, HasUuids;

    protected $table = 'notificationlist';

    protected $fillable = [
        'user_id',
        'notification_type',
        'type',
        'provider_id',
        'federation_id',
        'email',
        'phone',
        'is_enabled',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'is_approved' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }
}
