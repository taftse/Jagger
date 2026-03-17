<?php

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new Role())->getTable())->toBe('acl_role');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Role())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('type')
        ->toContain('description')
        ->toContain('parent_id');
});

it('has no timestamps', function (): void {
    expect((new Role())->usesTimestamps())->toBeFalse();
});

it('has many Acls', function (): void {
    expect((new Role())->acls())->toBeInstanceOf(HasMany::class);
});

it('belongs to a parent Role', function (): void {
    expect((new Role())->parent())->toBeInstanceOf(BelongsTo::class);
});

it('has many children Roles', function (): void {
    expect((new Role())->children())->toBeInstanceOf(HasMany::class);
});

it('belongs to many users', function (): void {
    expect((new Role())->members())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $role = Role::factory()->make();
    expect($role)->toBeInstanceOf(Role::class)
        ->and($role->name)->not->toBeNull()
        ->and($role->type)->toBeIn(['system', 'custom']);
});
