<?php

use App\Models\AclRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new AclRole())->getTable())->toBe('acl_role');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new AclRole())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('type')
        ->toContain('description')
        ->toContain('parent_id');
});

it('has no timestamps', function (): void {
    expect((new AclRole())->usesTimestamps())->toBeFalse();
});

it('has many Acls', function (): void {
    expect((new AclRole())->acls())->toBeInstanceOf(HasMany::class);
});

it('belongs to a parent AclRole', function (): void {
    expect((new AclRole())->parent())->toBeInstanceOf(BelongsTo::class);
});

it('has many children AclRoles', function (): void {
    expect((new AclRole())->children())->toBeInstanceOf(HasMany::class);
});

it('belongs to many users', function (): void {
    expect((new AclRole())->members())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $role = AclRole::factory()->make();
    expect($role)->toBeInstanceOf(AclRole::class)
        ->and($role->name)->not->toBeNull()
        ->and($role->type)->toBeIn(['system', 'custom']);
});
