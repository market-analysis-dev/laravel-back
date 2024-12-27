<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingFireProtectionSystem: string
{
    use EnumHelper;

    case HOSE_STATION = 'Hose Station';
    case SPRINKLER = 'Sprinkler';
    case EXTINGUISHER = 'Extinguisher';
}
