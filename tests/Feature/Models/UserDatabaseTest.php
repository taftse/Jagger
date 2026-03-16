<?php

use App\Models\AclRole;
use App\Models\NotificationList;
use App\Models\User;

it('can create and retrieve a user', function (): void {
    $user = User::factory()->create();
    expect(User::find($user->id))->not->toBeNull()
        ->and(User::find($user->id)->username)->toBe($user->username);
});

it('can assign a role to a user', function (): void {
    $user = User::factory()->create();
    $role = AclRole::factory()->create();

    $user->roles()->attach($role->id);

    expect($user->roles()->count())->toBe(1);
});

it('can have subscriptions', function (): void {
    $user = User::factory()->create();
    NotificationList::factory()->create(['subscriber' => $user->id]);

    expect($user->subscriptions()->count())->toBe(1);
});

it('creates a disabled user', function (): void {
    $user = User::factory()->disabled()->create();
    expect($user->enabled)->toBeFalse();
});
