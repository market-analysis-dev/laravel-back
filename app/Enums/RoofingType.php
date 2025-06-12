<?php
namespace App\Enums;

use App\Interfaces\Enums\HasTranslation;
use App\Traits\EnumHelper;

enum RoofingType: string
{
    use EnumHelper;

case BUTLER = 'Butler';
case KR18 = 'KR18';
case KR24 = 'KR24';
case SSR_LOK = 'SSR LOK';
case TPO = 'TPO';

}
