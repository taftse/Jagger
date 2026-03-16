<?php

use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Provider;
use App\Models\ServiceLocation;
use App\Models\StaticMetadata;

it('can create and retrieve a provider', function (): void {
    $provider = Provider::factory()->create();
    expect(Provider::find($provider->id))->not->toBeNull()
        ->and(Provider::find($provider->id)->entityid)->toBe($provider->entityid);
});

it('can add a certificate to a provider', function (): void {
    $provider = Provider::factory()->create();
    Certificate::factory()->create(['provider_id' => $provider->id]);

    expect($provider->certificates()->count())->toBe(1);
});

it('can add a contact to a provider', function (): void {
    $provider = Provider::factory()->create();
    Contact::factory()->create(['provider_id' => $provider->id]);

    expect($provider->contacts()->count())->toBe(1);
});

it('can add a service location to a provider', function (): void {
    $provider = Provider::factory()->create();
    ServiceLocation::factory()->create(['provider_id' => $provider->id]);

    expect($provider->serviceLocations()->count())->toBe(1);
});

it('can have static metadata', function (): void {
    $provider = Provider::factory()->create();
    StaticMetadata::factory()->create(['provider_id' => $provider->id]);

    expect($provider->metadata()->first())->not->toBeNull();
});

it('can create an IDP provider', function (): void {
    $idp = Provider::factory()->idp()->create();
    expect($idp->type)->toBe('IDP');
});

it('can create an SP provider', function (): void {
    $sp = Provider::factory()->sp()->create();
    expect($sp->type)->toBe('SP');
});
