<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingCertifications: string
{
    use EnumHelper;

    case NO = 'None';
    case LEED = 'LEED';
    case EDGE = 'EDGE';
    case BOMA = 'BOMA';
}
