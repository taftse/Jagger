<?php

namespace App\Models;

use Database\Factories\MailQueueFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailQueue extends Model
{
    /** @use HasFactory<MailQueueFactory> */
    use HasFactory, HasUuids;

    protected $table = 'mailqueue';

    public $timestamps = false;

    protected $fillable = [
        'deliverytype',
        'rcptto',
        'msubject',
        'mbody',
        'frequence',
        'createdat',
        'sentat',
        'issent',
    ];

    protected function casts(): array
    {
        return [
            'issent' => 'boolean',
            'createdat' => 'datetime',
            'sentat' => 'datetime',
        ];
    }
}
