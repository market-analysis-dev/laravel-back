<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum TechnicalImprovements: string
{
    use EnumHelper;

    case HAS_EXPANSION_LAND = 'has expansion land';
    case HAS_CRANE = 'has crane';
    case HAS_HVAC = 'has hvac';
    case HAS_RAIL_SPUR = 'has rail spur';
    case HAS_SPRINKLERS = 'has sprinklers';
    case HAS_OFFICE = 'has office';
    case HAS_LEED = 'has leed';
    case HAS_PRODUCTION_AREA = 'has production area';

}
