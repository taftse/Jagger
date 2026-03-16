<?php

use App\Models\ProviderStatsDef;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new ProviderStatsDef())->getTable())->toBe('providerstatsdef');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new ProviderStatsDef())->getFillable();
    expect($fillable)->toContain('shortname')
        ->toContain('titlename')
        ->toContain('provider_id')
        ->toContain('type');
});

it('belongs to a provider', function (): void {
    expect((new ProviderStatsDef())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('has many stats collections', function (): void {
    expect((new ProviderStatsDef())->statsCollection())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $def = ProviderStatsDef::factory()->make();
    expect($def)->toBeInstanceOf(ProviderStatsDef::class)
        ->and($def->shortname)->not->toBeNull()
        ->and($def->titlename)->not->toBeNull();
});
