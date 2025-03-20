<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingBuildingType: string
{
    use EnumHelper;

    case SPEC = 'Spec';
    case BTS = 'BTS';
    case BTS_EXPANSION = 'BTS Expansion';
    case EXPANSION = 'Expansion';
}
