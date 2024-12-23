<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingLoadingDoor: string
{
    use EnumHelper;
    
    case CROSSDOCK = 'Crossdock';
    case BACK_LOADING = 'Back Loading';
    case FRONT_LOADING = 'Front Loading';
}