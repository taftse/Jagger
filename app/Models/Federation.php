<?php

namespace App\Models;

use Database\Factories\FederationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Federation extends Model
{
    /** @use HasFactory<FederationFactory> */
    use HasFactory;

    protected $table = 'federation';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'sysname',
        'urn',
        'descriptorid',
        'publisher',
        'publisherexport',
        'description',
        'is_active',
        'is_protected',
        'is_public',
        'is_lexport',
        'is_local',
        'digest',
        'digestexport',
        'attrreq_inmeta',
        'tou',
        'usealtmetaurl',
        'altmetaurl',
        'owner',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_protected' => 'boolean',
            'is_public' => 'boolean',
            'is_lexport' => 'boolean',
            'is_local' => 'boolean',
            'attrreq_inmeta' => 'boolean',
            'usealtmetaurl' => 'boolean',
        ];
    }

    public function membership(): HasMany
    {
        return $this->hasMany(FederationMember::class, 'federation_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(FederationCategory::class, 'fedcategory_members', 'federation_id', 'fedcategory_id');
    }

    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(Partner::class, 'federation_partners', 'federation_id', 'partner_id');
    }

    public function validators(): HasMany
    {
        return $this->hasMany(FederationValidator::class, 'federation_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationList::class, 'federation_id');
    }

    public function attributeRequirements(): HasMany
    {
        return $this->hasMany(AttributeRequirement::class, 'fed_id');
    }
}
