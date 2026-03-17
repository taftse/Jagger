<?php

use App\Enums\AttributeRequirementStatus;
use App\Enums\AttributeRequirementType;
use App\Models\AttributeRequirement;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new AttributeRequirement())->getTable())->toBe('attribute_requirement');
});

it('has correct fillable attributes with snake_case FK names', function (): void {
    $fillable = (new AttributeRequirement())->getFillable();
    expect($fillable)->toContain('attribute_id')
        ->toContain('provider_id')
        ->toContain('federation_id')
        ->toContain('type')
        ->toContain('status')
        ->toContain('reason');
    expect($fillable)->not->toContain('sp_id')
        ->not->toContain('fed_id');
});

it('casts type as AttributeRequirementType enum', function (): void {
    $casts = (new AttributeRequirement())->getCasts();
    expect($casts['type'])->toBe(AttributeRequirementType::class);
});

it('casts status as AttributeRequirementStatus enum', function (): void {
    $casts = (new AttributeRequirement())->getCasts();
    expect($casts['status'])->toBe(AttributeRequirementStatus::class);
});

it('belongs to an attribute', function (): void {
    expect((new AttributeRequirement())->attribute())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a provider via provider_id', function (): void {
    $rel = (new AttributeRequirement())->provider();
    expect($rel)->toBeInstanceOf(BelongsTo::class)
        ->and($rel->getForeignKeyName())->toBe('provider_id');
});

it('belongs to a federation via federation_id', function (): void {
    $rel = (new AttributeRequirement())->federation();
    expect($rel)->toBeInstanceOf(BelongsTo::class)
        ->and($rel->getForeignKeyName())->toBe('federation_id');
});

it('can be created via factory', function (): void {
    $req = AttributeRequirement::factory()->make();
    expect($req)->toBeInstanceOf(AttributeRequirement::class)
        ->and($req->type)->toBeInstanceOf(AttributeRequirementType::class);
});
