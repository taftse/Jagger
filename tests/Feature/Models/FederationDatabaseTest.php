<?php

use App\Models\Federation;
use App\Models\FederationCategory;
use App\Models\FederationMember;
use App\Models\FederationValidator;
use App\Models\Provider;

it('can create and retrieve a federation', function (): void {
    $federation = Federation::factory()->create();
    expect(Federation::find($federation->id))->not->toBeNull()
        ->and(Federation::find($federation->id)->name)->toBe($federation->name);
});

it('can add a member to a federation', function (): void {
    $federation = Federation::factory()->create();
    $provider = Provider::factory()->create();

    FederationMember::factory()->create([
        'federation_id' => $federation->id,
        'provider_id' => $provider->id,
    ]);

    expect($federation->membership()->count())->toBe(1)
        ->and($federation->membership()->first()->provider_id)->toBe($provider->id);
});

it('can attach a category to a federation', function (): void {
    $federation = Federation::factory()->create();
    $category = FederationCategory::factory()->create();

    $federation->categories()->attach($category->id);

    expect($federation->categories()->count())->toBe(1);
});

it('can have validators', function (): void {
    $federation = Federation::factory()->create();
    FederationValidator::factory()->create(['federation_id' => $federation->id]);

    expect($federation->validators()->count())->toBe(1);
});
