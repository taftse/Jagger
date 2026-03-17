<?php

declare(strict_types=1);

namespace App\Enums;

enum ProviderType: string
{
    case IdentityProvider = 'IdentityProvider';
    case ServiceProvider = 'ServiceProvider';
    case Both = 'Both';
}
