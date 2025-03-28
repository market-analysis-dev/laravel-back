<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum UserType: string
{
    use EnumHelper;

    case ADMIN = 'Admin';
    case CLIENT = 'Client';
}
