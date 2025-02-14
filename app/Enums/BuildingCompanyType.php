<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingCompanyType:string
{
    use EnumHelper;

    case EXISTING_COMPANY = 'Existing Company';
    case NEW_IN_MARKET = 'New Company in Market';
    case NEW_IN_MEXICO = 'New Company in Mexico';
}
