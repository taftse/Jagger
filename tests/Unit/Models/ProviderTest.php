<?php

use App\Enums\ProviderType;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

it('has correct table name', function (): void {
    expect((new Provider())->getTable())->toBe('provider');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new Provider())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('entity_id')
        ->toContain('type')
        ->toContain('display_name')
        ->toContain('want_assert_signed')
        ->toContain('is_approved')
        ->toContain('hide_from_public');
});

it('casts type as ProviderType enum', function (): void {
    $casts = (new Provider())->getCasts();
    expect($casts['type'])->toBe(ProviderType::class);
});

it('casts boolean fields', function (): void {
    $casts = (new Provider())->getCasts();
    foreach (['is_approved', 'is_active', 'is_locked', 'is_static', 'is_local', 'hide_from_public'] as $field) {
        expect($casts[$field])->toBe('boolean');
    }
});

it('has federations BelongsToMany', function (): void {
    expect((new Provider())->federations())->toBeInstanceOf(BelongsToMany::class);
});

it('has contacts HasMany', function (): void {
    expect((new Provider())->contacts())->toBeInstanceOf(HasMany::class);
});

it('has certificates HasMany', function (): void {
    expect((new Provider())->certificates())->toBeInstanceOf(HasMany::class);
});

it('has samlMetadata HasOne', function (): void {
    expect((new Provider())->samlMetadata())->toBeInstanceOf(HasOne::class);
});

it('has codesOfConduct BelongsToMany', function (): void {
    expect((new Provider())->codesOfConduct())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory as IDP', function (): void {
    $provider = Provider::factory()->idp()->make();
    expect($provider)->toBeInstanceOf(Provider::class)
        ->and($provider->type)->toBe(ProviderType::IDP);
});

it('can be created via factory as SP', function (): void {
    $provider = Provider::factory()->sp()->make();
    expect($provider->type)->toBe(ProviderType::SP);
});
