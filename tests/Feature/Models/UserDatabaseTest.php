<?php

use App\Models\NotificationList;
use App\Models\Role;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create a user', function (): void {
    $user = User::factory()->create();

    $this->assertDatabaseHas('user', ['email' => $user->email]);
});

it('can create a disabled user', function (): void {
    $user = User::factory()->disabled()->create();

    expect($user->is_enabled)->toBeFalse();
});

it('can create a federated user', function (): void {
    $user = User::factory()->federated()->create();

    expect($user->is_federated)->toBeTrue()
        ->and($user->is_local)->toBeFalse();
});

it('can attach roles to a user', function (): void {
    $user = User::factory()->create();
    $role = Role::factory()->create();

    $user->roles()->attach($role);

    expect($user->roles()->count())->toBe(1);
});

it('can create notification subscriptions for a user', function (): void {
    $user = User::factory()->create();
    $subscription = NotificationList::factory()->create(['user_id' => $user->id]);

    expect($user->subscriptions()->count())->toBe(1);
});
