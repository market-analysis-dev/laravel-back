<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingStatus: string
{
    use EnumHelper;

    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
}
