<?php

use App\Models\Acl;
use App\Models\AclResource;
use App\Models\AclRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Acl())->getTable())->toBe('acl');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Acl())->getFillable();
    expect($fillable)->toContain('resource_id')
        ->toContain('role_id')
        ->toContain('action')
        ->toContain('access');
});

it('casts access as boolean', function (): void {
    $casts = (new Acl())->getCasts();
    expect($casts['access'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Acl())->usesTimestamps())->toBeFalse();
});

it('belongs to an AclResource', function (): void {
    $acl = new Acl();
    expect($acl->resource())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to an AclRole', function (): void {
    $acl = new Acl();
    expect($acl->role())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $acl = Acl::factory()->make();
    expect($acl)->toBeInstanceOf(Acl::class)
        ->and($acl->action)->not->toBeNull()
        ->and($acl->access)->toBeIn([true, false]);
});
