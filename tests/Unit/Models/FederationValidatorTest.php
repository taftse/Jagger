<?php

use App\Models\FederationValidator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new FederationValidator())->getTable())->toBe('fedvalidator');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new FederationValidator())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('federation_id')
        ->toContain('is_enabled')
        ->toContain('is_mandatory')
        ->toContain('is_reg_enabled')
        ->toContain('entity_param')
        ->toContain('arg_separator')
        ->toContain('document_type')
        ->toContain('return_code_element');
    expect($fillable)->not->toContain('entityparam')
        ->not->toContain('is_regenabled')
        ->not->toContain('argseparator')
        ->not->toContain('documenttype')
        ->not->toContain('returncodeelement');
});

it('casts boolean fields', function (): void {
    $casts = (new FederationValidator())->getCasts();
    expect($casts['is_enabled'])->toBe('boolean')
        ->and($casts['is_mandatory'])->toBe('boolean')
        ->and($casts['is_reg_enabled'])->toBe('boolean');
});

it('belongs to a federation', function (): void {
    expect((new FederationValidator())->federation())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $validator = FederationValidator::factory()->make();
    expect($validator)->toBeInstanceOf(FederationValidator::class)
        ->and($validator->name)->not->toBeNull();
});
