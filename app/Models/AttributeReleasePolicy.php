<?php

namespace App\Models;

use Database\Factories\AttributeReleasePolicyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeReleasePolicy extends Model
{
    /** @use HasFactory<AttributeReleasePolicyFactory> */
    use HasFactory;

    protected $table = 'attribute_release_policy';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'attribute_id',
        'idp_id',
        'requester',
    ];

    protected function casts(): array
    {
        return [
            'requester' => 'integer',
        ];
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function idp(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'idp_id');
    }
}
