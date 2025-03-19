<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingCertifications: string
{
    use EnumHelper;

    case NO = 'No';
    case LEED = 'LEED';
    case EDGE = 'EDGE';
    case BOMA = 'BOMA';
}
