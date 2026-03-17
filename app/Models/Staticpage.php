<?php

namespace App\Models;

use Database\Factories\StaticpageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staticpage extends Model
{
    /** @use HasFactory<StaticpageFactory> */
    use HasFactory, HasUuids;

    protected $table = 'staticpage';

    protected $fillable = [
        'pcode',
        'pcategory',
        'ptitle',
        'ptext',
        'ispublic',
        'enabled',
    ];

    protected function casts(): array
    {
        return [
            'ispublic' => 'boolean',
            'enabled' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
