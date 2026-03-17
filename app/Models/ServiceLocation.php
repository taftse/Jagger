<?php

namespace App\Models;

use App\Enums\ServiceLocationType;
use Database\Factories\ServiceLocationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceLocation extends Model
{
    /** @use HasFactory<ServiceLocationFactory> */
    use HasFactory, HasUuids;

    protected $table = 'service_location';

    protected $fillable = [
        'type',
        'binding_name',
        'url',
        'is_default',
        'ordered_no',
        'provider_id',
    ];

    protected function casts(): array
    {
        return [
            'type' => ServiceLocationType::class,
            'is_default' => 'boolean',
            'ordered_no' => 'integer',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
