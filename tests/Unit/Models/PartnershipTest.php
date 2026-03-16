<?php

use App\Models\Partnership;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Partnership())->getTable())->toBe('partnership');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Partnership())->getFillable();
    expect($fillable)->toContain('type')
        ->toContain('provider_id')
        ->toContain('partner_id');
});

it('has no timestamps', function (): void {
    expect((new Partnership())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new Partnership())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a partner', function (): void {
    expect((new Partnership())->partner())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $partnership = Partnership::factory()->make();
    expect($partnership)->toBeInstanceOf(Partnership::class)
        ->and($partnership->type)->toBeIn(['full', 'associate']);
});
