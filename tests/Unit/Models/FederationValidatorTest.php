<?php

use App\Models\FederationValidator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new FederationValidator())->getTable())->toBe('fedvalidator');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new FederationValidator())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('federation_id')
        ->toContain('is_enabled')
        ->toContain('url');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new FederationValidator())->getCasts();
    expect($casts['is_enabled'])->toBe('boolean')
        ->and($casts['is_mandatory'])->toBe('boolean')
        ->and($casts['is_regenabled'])->toBe('boolean');
});

it('belongs to a federation', function (): void {
    expect((new FederationValidator())->federation())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $validator = FederationValidator::factory()->make();
    expect($validator)->toBeInstanceOf(FederationValidator::class)
        ->and($validator->url)->not->toBeNull()
        ->and($validator->is_enabled)->toBeTrue();
});
