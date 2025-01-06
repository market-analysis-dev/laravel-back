<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Building extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'buildings';

    protected $fillable = [
        'region_id',
        'market_id',
        'sub_market_id',
        'builder_id',
        'industrial_park_id',
        'developer_id',
        'owner_id',
        'user_owner_id',
        'contact_id',
        'building_name',
        'class',
        'building_size_sf',
        'building_phase',
        'type_generation',
        'currency',
        'tenancy',
        'latitud',
        'longitud',
        'year_built',
        'clear_height',
        'total_land',
        'offices_space',
        'has_expansion_land',
        'has_crane',
        'has_hvac',
        'has_rail_spur',
        'has_sprinklers',
        'has_office',
        'has_leed',
        'new_construction',
        'starting_construction',
        'hvac_production_area',
        'construction_type',
        'lightning',
        'ventilation',
        'transformer_capacity',
        'construction_state',
        'roof_system',
        'fire_protection_system',
        'skylights_sf',
        'coverage',
        'kvas',
        'deal',
        'loading_door',
        'above_market_tis',
        'status',
        'created_by',
        'updated_by',
    ];
}
