<?php

use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Contact())->getTable())->toBe('contact');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Contact())->getFillable();
    expect($fillable)->toContain('givenname')
        ->toContain('surname')
        ->toContain('email')
        ->toContain('type')
        ->toContain('issirfty')
        ->toContain('provider_id');
});

it('casts issirfty as boolean', function (): void {
    $casts = (new Contact())->getCasts();
    expect($casts['issirfty'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Contact())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new Contact())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $contact = Contact::factory()->make();
    expect($contact)->toBeInstanceOf(Contact::class)
        ->and($contact->email)->not->toBeNull()
        ->and($contact->type)->toBeIn(['technical', 'administrative', 'support', 'billing', 'other']);
});
