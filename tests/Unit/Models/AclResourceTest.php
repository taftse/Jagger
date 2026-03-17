<?php

use App\Models\AclResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new AclResource())->getTable())->toBe('acl_resource');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new AclResource())->getFillable();
    expect($fillable)->toContain('resource')
        ->toContain('description')
        ->toContain('type')
        ->toContain('parent_id')
        ->toContain('default_value');
});

it('has no timestamps', function (): void {
    expect((new AclResource())->usesTimestamps())->toBeFalse();
});

it('belongs to a parent AclResource', function (): void {
    expect((new AclResource())->parent())->toBeInstanceOf(BelongsTo::class);
});

it('has many children AclResources', function (): void {
    expect((new AclResource())->children())->toBeInstanceOf(HasMany::class);
});

it('has many Acls', function (): void {
    expect((new AclResource())->acls())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $resource = AclResource::factory()->make();
    expect($resource)->toBeInstanceOf(AclResource::class)
        ->and($resource->resource)->not->toBeNull();
});
