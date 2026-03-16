<?php

namespace App\Models;

use Database\Factories\ServiceLocationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceLocation extends Model
{
    /** @use HasFactory<ServiceLocationFactory> */
    use HasFactory;

    protected $table = 'service_location';

    public $timestamps = false;

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
            'is_default' => 'boolean',
            'ordered_no' => 'integer',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
