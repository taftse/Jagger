<?php

namespace App\Models;

use App\Enums\ContactType;
use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    /** @use HasFactory<ContactFactory> */
    use HasFactory, HasUuids;

    protected $table = 'contact';

    public $timestamps = false;

    protected $fillable = [
        'given_name',
        'surname',
        'email',
        'type',
        'is_sirtfi',
        'phone',
        'provider_id',
    ];

    protected function casts(): array
    {
        return [
            'is_sirtfi' => 'boolean',
            'type' => ContactType::class,
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
