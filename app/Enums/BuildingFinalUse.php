<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingFinalUse: string
{
    use EnumHelper;

    case LOGISTIC = 'Logistics';
    case MANUFACTURING = 'Manufacturing';
    case TBD = 'TBD';
}
