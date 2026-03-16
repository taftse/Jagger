<?php

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Certificate())->getTable())->toBe('certificate');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Certificate())->getFillable();
    expect($fillable)->toContain('type')
        ->toContain('certdata')
        ->toContain('provider_id')
        ->toContain('is_default');
});

it('casts is_default as boolean', function (): void {
    $casts = (new Certificate())->getCasts();
    expect($casts['is_default'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Certificate())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new Certificate())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $cert = Certificate::factory()->make();
    expect($cert)->toBeInstanceOf(Certificate::class)
        ->and($cert->type)->not->toBeNull()
        ->and($cert->is_default)->toBeTrue();
});
