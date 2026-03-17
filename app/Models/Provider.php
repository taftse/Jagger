<?php

namespace App\Models;

use App\Enums\ProviderType;
use Database\Factories\ProviderFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Provider extends Model
{
    /** @use HasFactory<ProviderFactory> */
    use HasFactory, HasUuids;

    protected $table = 'provider';

    protected $fillable = [
        'name',
        'localized_name',
        'display_name',
        'localized_display_name',
        'entity_id',
        'nameid_format',
        'name_ids',
        'protocol',
        'protocol_support',
        'type',
        'want_assert_signed',
        'want_authn_req_signed',
        'authn_req_signed',
        'scope',
        'digest',
        'helpdesk_url',
        'localized_helpdesk_url',
        'privacy_url',
        'localized_privacy_url',
        'registrar',
        'register_date',
        'reg_policy',
        'valid_from',
        'valid_to',
        'description',
        'country',
        'wayf_list',
        'exc_arps',
        'is_approved',
        'is_active',
        'is_locked',
        'is_static',
        'is_local',
        'hide_from_public',
        'owner_id',
    ];

    protected function casts(): array
    {
        return [
            'type' => ProviderType::class,
            'want_assert_signed' => 'boolean',
            'want_authn_req_signed' => 'boolean',
            'authn_req_signed' => 'boolean',
            'is_approved' => 'boolean',
            'is_active' => 'boolean',
            'is_locked' => 'boolean',
            'is_static' => 'boolean',
            'is_local' => 'boolean',
            'hide_from_public' => 'boolean',
            'register_date' => 'datetime',
            'valid_from' => 'datetime',
            'valid_to' => 'datetime',
        ];
    }

    public function federations(): BelongsToMany
    {
        return $this->belongsToMany(Federation::class, 'federation_members', 'provider_id', 'federation_id')
            ->using(FederationMember::class)
            ->withPivot(['join_state', 'is_disabled', 'is_banned']);
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
        return $this->hasMany(AttributeReleasePolicy::class, 'provider_id');
    }

    public function attributeRequirements(): HasMany
    {
        return $this->hasMany(AttributeRequirement::class, 'provider_id');
    }

    public function samlMetadata(): HasOne
    {
        return $this->hasOne(Metadata::class, 'provider_id');
    }

    public function extendedMetadata(): HasMany
    {
        return $this->hasMany(ExtendMetadata::class, 'provider_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationList::class, 'provider_id');
    }

    public function statsDefinitions(): HasMany
    {
        return $this->hasMany(ProviderStatsDef::class, 'provider_id');
    }

    public function statsCollections(): HasMany
    {
        return $this->hasMany(ProviderStatsCollection::class, 'provider_id');
    }

    public function codesOfConduct(): BelongsToMany
    {
        return $this->belongsToMany(CodeOfConduct::class, 'Provider_Coc', 'provider_id', 'coc_id');
    }
}
