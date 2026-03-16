<?php

namespace App\Models;

use Database\Factories\FederationValidatorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FederationValidator extends Model
{
    /** @use HasFactory<FederationValidatorFactory> */
    use HasFactory;

    protected $table = 'fedvalidator';

    protected $fillable = [
        'name',
        'federation_id',
        'is_enabled',
        'is_mandatory',
        'is_regenabled',
        'url',
        'method',
        'entityparam',
        'optargs',
        'argseparator',
        'documenttype',
        'description',
        'returncodeelement',
        'returncodevalue',
        'messagecodeelement',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'is_mandatory' => 'boolean',
            'is_regenabled' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }
}
