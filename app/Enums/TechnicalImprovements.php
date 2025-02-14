<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum TechnicalImprovements: string
{
    use EnumHelper;

    case LAND_EXPANSION = 'Land Expansion';
    case CRANE = 'CRANE';
    case HVAC = 'HVAC';
    case RAIL_SPUR = 'Rail Spur';
    case SPRINKLERS = 'Sprinklers';
    case OFFICE = 'Office';
    case LEED = 'Leed';
    case CROSSDOCK = 'Crossdock';
}
