<?php

namespace App\Models;

use Database\Factories\FederationMemberFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FederationMember extends Model
{
    /** @use HasFactory<FederationMemberFactory> */
    use HasFactory;

    protected $table = 'federation_members';

    public $timestamps = false;

    protected $fillable = [
        'provider_id',
        'federation_id',
        'joinstate',
        'isdisabled',
        'isbanned',
    ];

    protected function casts(): array
    {
        return [
            'joinstate' => 'integer',
            'isdisabled' => 'boolean',
            'isbanned' => 'boolean',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }
}
