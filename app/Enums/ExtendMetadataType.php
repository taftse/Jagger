<?php

declare(strict_types=1);

namespace App\Enums;

enum ExtendMetadataType: string
{
    case Element = 'element';
    case Attribute = 'attribute';
}
