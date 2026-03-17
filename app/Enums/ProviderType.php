<?php

declare(strict_types=1);

namespace App\Enums;

enum ProviderType: string
{
    case IDP = 'IdentityProvider';
    case SP = 'ServiceProvider';
    case Both = 'Both';
}
