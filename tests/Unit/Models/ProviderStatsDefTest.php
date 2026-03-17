<?php

use App\Models\ProviderStatsDef;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new ProviderStatsDef())->getTable())->toBe('providerstatsdef');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new ProviderStatsDef())->getFillable();
    expect($fillable)->toContain('short_name')
        ->toContain('title_name')
        ->toContain('predefined_col')
        ->toContain('format_type')
        ->toContain('source_url')
        ->toContain('access_type')
        ->toContain('auth_user')
        ->toContain('auth_pass')
        ->toContain('display_options')
        ->toContain('post_options');
    expect($fillable)->not->toContain('shortname')
        ->not->toContain('titlename')
        ->not->toContain('formattype');
});

it('belongs to a provider', function (): void {
    expect((new ProviderStatsDef())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('has many stats collections', function (): void {
    expect((new ProviderStatsDef())->statsCollections())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $def = ProviderStatsDef::factory()->make();
    expect($def)->toBeInstanceOf(ProviderStatsDef::class)
        ->and($def->short_name)->not->toBeNull();
});
