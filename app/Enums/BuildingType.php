<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingType: string
{
    use EnumHelper;

    case BTS = 'BTS';
    case EXPANSION = 'Expansion';
    case INVENTORY = 'Inventory';
    case CONSTRUCTION = 'Construction';
    case PLANNED = 'Planned';
    case SUBLEASE = 'Sublease';
    case EXPIRATION = 'Expiration';

}
