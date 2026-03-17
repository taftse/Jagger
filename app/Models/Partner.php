<?php

namespace App\Models;

use Database\Factories\PartnerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partner extends Model
{
    /** @use HasFactory<PartnerFactory> */
    use HasFactory, HasUuids;

    protected $table = 'partner';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'contact',
        'phone',
        'home_url',
        'description',
    ];

    public function federations(): BelongsToMany
    {
        return $this->belongsToMany(Federation::class, 'federation_partners', 'partner_id', 'federation_id');
    }
}
