<?php

declare(strict_types=1);

namespace App\Enums;

enum CertificateType: string
{
    case IdentityProviderSSO = 'idpsso';
    case ServiceProviderSSO = 'spsso';
    case Sso = 'sso';
    case Encryption = 'encryption';
}
