<?php

use App\Models\Partner;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('has correct table name', function (): void {
    expect((new Partner())->getTable())->toBe('partner');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new Partner())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('contact')
        ->toContain('phone')
        ->toContain('home_url')
        ->toContain('description');
    expect($fillable)->not->toContain('homeurl');
});

it('belongs to many federations', function (): void {
    expect((new Partner())->federations())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $partner = Partner::factory()->make();
    expect($partner)->toBeInstanceOf(Partner::class)
        ->and($partner->name)->not->toBeNull()
        ->and($partner->home_url)->not->toBeNull();
});
