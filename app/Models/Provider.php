<?php

namespace App\Models;

use Database\Factories\ProviderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Provider extends Model
{
    /** @use HasFactory<ProviderFactory> */
    use HasFactory;

    protected $table = 'provider';

    protected $fillable = [
        'name',
        'lname',
        'displayname',
        'ldisplayname',
        'entityid',
        'nameidformat',
        'nameids',
        'protocol',
        'protocolsupport',
        'type',
        'wantassertsigned',
        'wantauthnreqsigned',
        'authnreqsigned',
        'scope',
        'digest',
        'helpdeskurl',
        'lhelpdeskurl',
        'privacyurl',
        'lprivacyurl',
        'registrar',
        'registerdate',
        'regpolicy',
        'validfrom',
        'validto',
        'description',
        'country',
        'wayflist',
        'excarps',
        'is_approved',
        'is_active',
        'is_locked',
        'is_static',
        'is_local',
        'hidepublic',
        'owner_id',
    ];

    protected function casts(): array
    {
        return [
            'wantassertsigned' => 'boolean',
            'wantauthnreqsigned' => 'boolean',
            'authnreqsigned' => 'boolean',
            'is_approved' => 'boolean',
            'is_active' => 'boolean',
            'is_locked' => 'boolean',
            'is_static' => 'boolean',
            'is_local' => 'boolean',
            'hidepublic' => 'boolean',
            'registerdate' => 'datetime',
            'validfrom' => 'datetime',
            'validto' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function membership(): HasMany
    {
        return $this->hasMany(FederationMember::class, 'provider_id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'provider_id');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'provider_id');
    }

    public function serviceLocations(): HasMany
    {
        return $this->hasMany(ServiceLocation::class, 'provider_id');
    }

    public function attributeReleasePolicies(): HasMany
    {
        return $this->hasMany(AttributeReleasePolicy::class, 'idp_id');
    }

    public function attributeRequirements(): HasMany
    {
        return $this->hasMany(AttributeRequirement::class, 'sp_id');
    }

    public function metadata(): HasOne
    {
        return $this->hasOne(StaticMetadata::class, 'provider_id');
    }

    public function extendMetadata(): HasMany
    {
        return $this->hasMany(ExtendMetadata::class, 'provider_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationList::class, 'provider');
    }

    public function statsDef(): HasMany
    {
        return $this->hasMany(ProviderStatsDef::class, 'provider_id');
    }

    public function statsCollection(): HasMany
    {
        return $this->hasMany(ProviderStatsCollection::class, 'provider_id');
    }

    public function coc(): BelongsToMany
    {
        return $this->belongsToMany(Coc::class, 'Provider_Coc', 'provider_id', 'coc_id');
    }
}
