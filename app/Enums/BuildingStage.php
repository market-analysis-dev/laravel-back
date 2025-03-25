<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingStage: string
{
    use EnumHelper;
case Availability = 'Availability';
case Construction = 'Construction';
case Leased = 'Leased';
case Sold = 'Sold';
}
