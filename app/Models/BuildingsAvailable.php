<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingsAvailable extends Model
{
    use HasFactory;

    protected $table = 'buildings_available';

    protected $fillable = [
        'building_id',
        'available_sf',
        'minimum_space_sf',
        'expansion_up_to_sf',
        'dock_doors',
        'drive_in_door',
        'floor_thickness',
        'floor_resistance',
        'truck_court',
        'crossdock',
        'shared_truck',
        'building_dimensions_1',
        'building_dimensions_2',
        'bay_Size_1',
        'bay_Size_2',
        'columns_spacing_1',
        'columns_spacing_2',
        'knockouts_docks',
        'parking_space',
        'available_month',
        'available_year',
        'min_lease',
        'max_lease'
    ];

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
