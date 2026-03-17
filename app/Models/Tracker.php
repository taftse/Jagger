<?php

namespace App\Models;

use Database\Factories\TrackerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Tracks resource access / audit events (downloads, metadata refreshes, logins, etc.)
 */
class Tracker extends Model
{
    /** @use HasFactory<TrackerFactory> */
    use HasFactory, HasUuids;

    protected $table = 'tracker';

    public $timestamps = false;

    protected $fillable = [
        'resource_type',
        'subtype',
        'resource_name',
        'source_ip',
        'user_agent',
        'user',
        'created_at',
        'detail',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
