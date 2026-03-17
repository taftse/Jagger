<?php

use App\Enums\CertificateType;
use App\Enums\CertificateUsage;
use App\Enums\ContactType;
use App\Enums\ProviderType;
use App\Enums\ServiceLocationType;
use App\Models\Certificate;
use App\Models\CodeOfConduct;
use App\Models\Contact;
use App\Models\Provider;
use App\Models\ServiceLocation;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create a provider with ProviderType enum', function (): void {
    $provider = Provider::factory()->idp()->create();

    $this->assertDatabaseHas('provider', ['id' => $provider->id]);
    expect($provider->type)->toBe(ProviderType::IdentityProvider);
});

it('can associate certificates with snake_case fields', function (): void {
    $provider = Provider::factory()->create();

    $cert = Certificate::factory()->create([
        'provider_id' => $provider->id,
        'type' => CertificateType::ServiceProviderSSO,
        'cert_usage' => CertificateUsage::Encryption,
    ]);

    expect($provider->certificates()->count())->toBe(1)
        ->and($cert->type)->toBe(CertificateType::ServiceProviderSSO)
        ->and($cert->cert_usage)->toBe(CertificateUsage::Encryption);
});

it('can associate contacts with ContactType enum', function (): void {
    $provider = Provider::factory()->create();

    Contact::factory()->create([
        'provider_id' => $provider->id,
        'type' => ContactType::Administrative,
    ]);

    expect($provider->contacts()->count())->toBe(1)
        ->and($provider->contacts()->first()->type)->toBe(ContactType::Administrative);
});

it('can associate service locations with ServiceLocationType enum', function (): void {
    $provider = Provider::factory()->sp()->create();

    ServiceLocation::factory()->create([
        'provider_id' => $provider->id,
        'type' => ServiceLocationType::AssertionConsumerService,
    ]);

    expect($provider->serviceLocations()->count())->toBe(1)
        ->and($provider->serviceLocations()->first()->type)->toBe(ServiceLocationType::AssertionConsumerService);
});

it('can associate codes of conduct', function (): void {
    $provider = Provider::factory()->create();
    $coc = CodeOfConduct::factory()->create();

    $provider->codesOfConduct()->attach($coc);

    expect($provider->codesOfConduct()->count())->toBe(1);
});
