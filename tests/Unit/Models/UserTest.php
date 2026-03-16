<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new User())->getTable())->toBe('user');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new User())->getFillable();
    expect($fillable)->toContain('username')
        ->toContain('email')
        ->toContain('password')
        ->toContain('givenname')
        ->toContain('surname');
});

it('hides password and salt', function (): void {
    $hidden = (new User())->getHidden();
    expect($hidden)->toContain('password')
        ->toContain('salt');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new User())->getCasts();
    expect($casts['local'])->toBe('boolean')
        ->and($casts['federated'])->toBe('boolean')
        ->and($casts['approved'])->toBe('boolean')
        ->and($casts['enabled'])->toBe('boolean')
        ->and($casts['validated'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new User())->usesTimestamps())->toBeFalse();
});

it('belongs to many roles', function (): void {
    expect((new User())->roles())->toBeInstanceOf(BelongsToMany::class);
});

it('has many subscriptions', function (): void {
    expect((new User())->subscriptions())->toBeInstanceOf(HasMany::class);
});

it('has many queue entries', function (): void {
    expect((new User())->queueEntries())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $user = User::factory()->make();
    expect($user)->toBeInstanceOf(User::class)
        ->and($user->username)->not->toBeNull()
        ->and($user->email)->not->toBeNull()
        ->and($user->enabled)->toBeTrue()
        ->and($user->approved)->toBeTrue();
});

it('can create a disabled user via factory state', function (): void {
    $user = User::factory()->disabled()->make();
    expect($user->enabled)->toBeFalse();
});

it('can create a federated user via factory state', function (): void {
    $user = User::factory()->federated()->make();
    expect($user->federated)->toBeTrue()
        ->and($user->local)->toBeFalse();
});
