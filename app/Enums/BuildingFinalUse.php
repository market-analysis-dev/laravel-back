<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingFinalUse: string
{
    use EnumHelper;

    case LOGISTIC = 'Logistic';
    case MANUFACTURING = 'Manufacturing';
    case TBD = 'TBD';
}
