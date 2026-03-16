<?php

namespace App\Models;

use Database\Factories\PreferencesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    /** @use HasFactory<PreferencesFactory> */
    use HasFactory;

    protected $table = 'preferences';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'stype',
        'scategory',
        'descname',
        'pvalue',
        'serializedvalue',
        'is_enabled',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
        ];
    }
}
