<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class BuildingAvailable extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'buildings_available';

    protected $fillable = [
        'building_id',
        'abs_tenant_id',
        'abs_industry_id',
        'abs_shelter_id',
        'abs_country_id',
        'broker_id',
        'building_state',
        'avl_size_sf',
        'avl_building_dimensions',
        'avl_building_phase',
        'abs_building_phase',
        'avl_minimum_space_sf',
        'avl_expansion_up_to_sf',
        'dock_doors',
        'drive_in_door',
        'floor_thickness',
        'floor_resistance',
        'truck_court',
        'has_crossdock',
        'shared_truck',
        'new_construction',
        'is_starting_construction',
        'bay_size',
        'columns_spacing',
        'avl_date',
        'abs_lease_term_month',
        'knockouts_docks',
        'parking_space',
        'avl_min_lease',
        'avl_max_lease',
        'abs_asking_rate_shell',
        'abs_closing_rate',
        'abs_closing_date',
        'abs_lease_up',
        'abs_month',
        'abs_final_use',
        'abs_company_type',
        'abs_sale_price'
    ];
}
