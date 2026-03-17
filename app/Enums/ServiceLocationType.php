<?php

declare(strict_types=1);

namespace App\Enums;

enum ServiceLocationType: string
{
    case AssertionConsumerService = 'AssertionConsumerService';
    case SingleLogoutService = 'SingleLogoutService';
    case RequestInitiator = 'RequestInitiator';
    case DiscoveryResponse = 'DiscoveryResponse';
    case AttributeConsumingService = 'AttributeConsumingService';
}
