<?php

use App\Models\FederationMember;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

it('extends MorphPivot', function (): void {
    expect(new FederationMember())->toBeInstanceOf(MorphPivot::class);
});

it('has correct table name', function (): void {
    expect((new FederationMember())->getTable())->toBe('federation_members');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new FederationMember())->getFillable();
    expect($fillable)->toContain('provider_id')
        ->toContain('federation_id')
        ->toContain('join_state')
        ->toContain('is_disabled')
        ->toContain('is_banned');
});

it('casts fields correctly', function (): void {
    $casts = (new FederationMember())->getCasts();
    expect($casts['is_disabled'])->toBe('boolean')
        ->and($casts['is_banned'])->toBe('boolean')
        ->and($casts['join_state'])->toBe('integer');
});

it('belongs to a provider', function (): void {
    expect((new FederationMember())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a federation', function (): void {
    expect((new FederationMember())->federation())->toBeInstanceOf(BelongsTo::class);
});
