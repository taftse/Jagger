<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

it('extends Authenticatable', function (): void {
    expect(new User())->toBeInstanceOf(Authenticatable::class);
});

it('has correct table name', function (): void {
    expect((new User())->getTable())->toBe('user');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new User())->getFillable();
    expect($fillable)->toContain('email')
        ->toContain('password')
        ->toContain('old_password')
        ->toContain('old_salt')
        ->toContain('username')
        ->toContain('given_name')
        ->toContain('surname')
        ->toContain('is_local')
        ->toContain('is_federated')
        ->toContain('is_approved')
        ->toContain('is_enabled');
});

it('hides sensitive fields', function (): void {
    $hidden = (new User())->getHidden();
    expect($hidden)->toContain('password')
        ->toContain('old_password')
        ->toContain('old_salt')
        ->toContain('remember_token');
});

it('casts boolean flags', function (): void {
    $casts = (new User())->getCasts();
    foreach (['is_local', 'is_federated', 'is_approved', 'is_enabled', 'is_validated'] as $field) {
        expect($casts[$field])->toBe('boolean');
    }
});

it('belongs to many roles', function (): void {
    expect((new User())->roles())->toBeInstanceOf(BelongsToMany::class);
});

it('has many notification subscriptions', function (): void {
    expect((new User())->subscriptions())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $user = User::factory()->make();
    expect($user)->toBeInstanceOf(User::class)
        ->and($user->email)->not->toBeNull()
        ->and($user->is_enabled)->toBeTrue();
});

it('factory disabled state works', function (): void {
    $user = User::factory()->disabled()->make();
    expect($user->is_enabled)->toBeFalse();
});

it('factory federated state works', function (): void {
    $user = User::factory()->federated()->make();
    expect($user->is_federated)->toBeTrue()
        ->and($user->is_local)->toBeFalse();
});
