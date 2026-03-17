<?php

namespace App\Models;

use Database\Factories\FederationValidatorFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FederationValidator extends Model
{
    /** @use HasFactory<FederationValidatorFactory> */
    use HasFactory, HasUuids;

    protected $table = 'fedvalidator';

    protected $fillable = [
        'name',
        'federation_id',
        'is_enabled',
        'is_mandatory',
        'is_reg_enabled',
        'url',
        'method',
        'entity_param',
        'opt_args',
        'arg_separator',
        'document_type',
        'description',
        'return_code_element',
        'return_code_value',
        'message_code_element',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'is_mandatory' => 'boolean',
            'is_reg_enabled' => 'boolean',
        ];
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }
}
