<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingTypeFile :string
{
    use EnumHelper;

    case FONT_PAGE = 'Font Page'; 
    case GALLERY = 'Gallery'; 
    case AERIAL = 'Aerial'; 
    case THREE_SIXTY = '360'; 
    case LAYOUT = 'Layout'; 
    case BROCHURE = 'Brochure'; 
    case KMZ = 'KMZ'; 
}