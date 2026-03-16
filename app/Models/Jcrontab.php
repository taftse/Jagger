<?php

namespace App\Models;

use Database\Factories\JcrontabFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jcrontab extends Model
{
    /** @use HasFactory<JcrontabFactory> */
    use HasFactory;

    protected $table = 'jcrontab';

    public $timestamps = false;

    protected $fillable = [
        'jminute',
        'jhour',
        'jdayofmonth',
        'jmonth',
        'jdayofweek',
        'jcommand',
        'jparams',
        'jservers',
        'tonotify',
        'jcomment',
        'isenabled',
        'istemplate',
        'lastrun',
    ];

    protected function casts(): array
    {
        return [
            'tonotify' => 'boolean',
            'isenabled' => 'boolean',
            'istemplate' => 'boolean',
            'lastrun' => 'datetime',
        ];
    }
}
