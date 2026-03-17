<?php

namespace App\Models;

use Database\Factories\JaggerQueueFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JaggerQueue extends Model
{
    /** @use HasFactory<JaggerQueueFactory> */
    use HasFactory, HasUuids;

    protected $table = 'queue';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'action',
        'recipient',
        'recipienttype',
        'type',
        'objdata',
        'objtype',
        'creator',
        'email',
        'fullname',
        'srcip',
        'token',
        'is_confirmed',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'is_confirmed' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator');
    }
}
