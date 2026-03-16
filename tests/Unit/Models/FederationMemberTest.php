<?php

use App\Models\FederationMember;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new FederationMember())->getTable())->toBe('federation_members');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new FederationMember())->getFillable();
    expect($fillable)->toContain('provider_id')
        ->toContain('federation_id')
        ->toContain('joinstate')
        ->toContain('isdisabled')
        ->toContain('isbanned');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new FederationMember())->getCasts();
    expect($casts['isdisabled'])->toBe('boolean')
        ->and($casts['isbanned'])->toBe('boolean')
        ->and($casts['joinstate'])->toBe('integer');
});

it('has no timestamps', function (): void {
    expect((new FederationMember())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new FederationMember())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a federation', function (): void {
    expect((new FederationMember())->federation())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $member = FederationMember::factory()->make();
    expect($member)->toBeInstanceOf(FederationMember::class)
        ->and($member->joinstate)->toBe(0)
        ->and($member->isdisabled)->toBeFalse()
        ->and($member->isbanned)->toBeFalse();
});
