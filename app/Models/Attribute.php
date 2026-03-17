<?php

namespace App\Models;

use Database\Factories\AttributeFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /** @use HasFactory<AttributeFactory> */
    use HasFactory, HasUuids;

    protected $table = 'attribute';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'full_name',
        'oid',
        'urn',
        'in_metadata',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'in_metadata' => 'boolean',
        ];
    }
}
