<?php

namespace App\Models;

use App\Enums\CertificateType;
use App\Enums\CertificateUsage;
use Database\Factories\CertificateFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    /** @use HasFactory<CertificateFactory> */
    use HasFactory, HasUuids;

    protected $table = 'certificate';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'cert_usage',
        'cert_type',
        'cert_data',
        'enc_methods',
        'subject',
        'provider_id',
        'is_default',
        'key_name',
    ];

    protected function casts(): array
    {
        return [
            'type' => CertificateType::class,
            'cert_usage' => CertificateUsage::class,
            'is_default' => 'boolean',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
