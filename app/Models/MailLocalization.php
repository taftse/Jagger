<?php

namespace App\Models;

use Database\Factories\MailLocalizationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLocalization extends Model
{
    /** @use HasFactory<MailLocalizationFactory> */
    use HasFactory, HasUuids;

    protected $table = 'maillocalization';

    public $timestamps = false;

    protected $fillable = [
        'mgroup',
        'lang',
        'msgbody',
        'msgsubject',
        'isdefault',
        'isenabled',
        'alwaysattach',
    ];

    protected function casts(): array
    {
        return [
            'isdefault' => 'boolean',
            'isenabled' => 'boolean',
            'alwaysattach' => 'boolean',
        ];
    }
}
