<?php

namespace App\Models;

use Database\Factories\InvitationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Invitation extends Model
{
    /** @use HasFactory<InvitationFactory> */
    use HasFactory, HasUuids;

    protected $table = 'invitation';

    protected $fillable = [
        'token',
        'validation_key',
        'mail_from',
        'mail_to',
        'valid_till',
        'is_valid',
        'actiontype',
        'actionvalue',
        'target_type',
        'target_id',
    ];

    protected function casts(): array
    {
        return [
            'is_valid' => 'boolean',
            'valid_till' => 'datetime',
        ];
    }

    /**
     * Polymorphic relation to the invitation target (Provider, Federation, etc.)
     */
    public function target(): MorphTo
    {
        return $this->morphTo('target');
    }
}
