<?php

use App\Models\Federation;
use App\Models\FederationCategory;
use App\Models\Provider;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create a federation', function (): void {
    $fed = Federation::factory()->create();

    $this->assertDatabaseHas('federation', ['id' => $fed->id]);
});

it('members() links providers via FederationMember pivot', function (): void {
    $fed = Federation::factory()->create();
    $provider = Provider::factory()->create();

    $fed->members()->attach($provider->id, [
        'join_state' => 1,
        'is_disabled' => false,
        'is_banned' => false,
    ]);

    expect($fed->members()->count())->toBe(1)
        ->and($fed->members()->first()->id)->toBe($provider->id);
});

it('federation pivot has join_state and flags', function (): void {
    $fed = Federation::factory()->create();
    $provider = Provider::factory()->create();

    $fed->members()->attach($provider->id, [
        'join_state' => 2,
        'is_disabled' => true,
        'is_banned' => false,
    ]);

    $pivot = $fed->members()->withPivot(['join_state', 'is_disabled', 'is_banned'])->first()->pivot;
    expect($pivot->join_state)->toBe(2)
        ->and($pivot->is_disabled)->toBe(1);
});

it('can attach categories to federation', function (): void {
    $fed = Federation::factory()->create();
    $cat = FederationCategory::factory()->create();

    $fed->categories()->attach($cat);

    expect($fed->categories()->count())->toBe(1);
});
