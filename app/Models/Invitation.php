<?php

namespace App\Models;

use Database\Factories\InvitationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /** @use HasFactory<InvitationFactory> */
    use HasFactory;

    protected $table = 'invitation';

    public $timestamps = false;

    protected $fillable = [
        'token',
        'validationkey',
        'mailfrom',
        'mailto',
        'created_at',
        'validto',
        'is_valid',
        'targettype',
        'targetid',
        'actiontype',
        'actionvalue',
    ];

    protected function casts(): array
    {
        return [
            'is_valid' => 'boolean',
        ];
    }
}
