<?php

namespace App\Models;

use Database\Factories\PartnershipFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partnership extends Model
{
    /** @use HasFactory<PartnershipFactory> */
    use HasFactory;

    protected $table = 'partnership';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'provider_id',
        'partner_id',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
