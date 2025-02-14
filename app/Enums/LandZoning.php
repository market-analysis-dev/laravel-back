<?php
namespace App\Enums;

use App\Traits\EnumHelper;

enum LandZoning: string
{
    use EnumHelper;

    case INDUSTRIAL = 'Industrial';
    case COMMERCIAL = 'Commercial';
    case RESIDENTIAL = 'Residential';
}
