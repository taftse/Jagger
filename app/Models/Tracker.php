<?php

namespace App\Models;

use Database\Factories\TrackerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    /** @use HasFactory<TrackerFactory> */
    use HasFactory;

    protected $table = 'tracker';

    public $timestamps = false;

    protected $fillable = [
        'resourcetype',
        'subtype',
        'resourcename',
        'sourceip',
        'useragent',
        'user',
        'created_at',
        'detail',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
