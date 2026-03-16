<?php

namespace App\Models;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    /** @use HasFactory<ContactFactory> */
    use HasFactory;

    protected $table = 'contact';

    public $timestamps = false;

    protected $fillable = [
        'givenname',
        'surname',
        'email',
        'type',
        'issirfty',
        'phone',
        'provider_id',
    ];

    protected function casts(): array
    {
        return [
            'issirfty' => 'boolean',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
