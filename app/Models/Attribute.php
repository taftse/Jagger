<?php

namespace App\Models;

use Database\Factories\AttributeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /** @use HasFactory<AttributeFactory> */
    use HasFactory;

    protected $table = 'attribute';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'fullname',
        'oid',
        'urn',
        'inmetadata',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'inmetadata' => 'boolean',
        ];
    }
}
