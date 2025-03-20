<?php

namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum BuildingOwnerType: string
{
    use EnumHelper;
case Investor = 'Investor';
case REITS = 'REITS';
case Developer = 'Developer';
case UserOwner = 'User Owner';
case Builder = 'Builder';
case PrivateOwner = 'Private Owner';

}
