<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class BuildingAvailableLog extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'buildings_available_log';

    protected $fillable = [
        'building_available_id',
        'building_id',
        'rams',
        'trailer_parking_space',
        'above_market_tis',
        'abs_tenant_id',
        'abs_industry_id',
        'abs_shelter_id',
        'abs_country_id',
        'broker_id',
        'building_state',
        'size_sf',
        'avl_building_dimensions_ft',
        'avl_building_phase',
        'abs_building_phase',
        'avl_minimum_space_sf',
        'avl_expansion_up_to_sf',
        'dock_doors',
        'drive_in_door',
        'floor_thickness',
        'floor_resistance',
        'truck_court_ft',
        'has_crossdock',
        'shared_truck',
        'new_construction',
        'is_starting_construction',
        'bay_size',
        'avl_date',
        'abs_lease_term_month',
        'knockouts_docks',
        'parking_space',
        'avl_min_lease',
        'avl_max_lease',
        'abs_closing_rate',
        'abs_closing_date',
        'abs_lease_up',
        'abs_month',
        'abs_final_use',
        'abs_company_type',
        'abs_sale_price',
        'abs_shelter_id',
        'abs_broker_id',
        'has_expansion_land',
        'has_crane',
        'has_hvac',
        'has_rail_spur',
        'has_sprinklers',
        'has_office',
        'has_leed',
        'abs_deal',
        'currency',
        'fire_protection_system',
        'is_negative_absorption',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function buildingAvailable(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BuildingAvailable::class, 'building_available_id');
    }

    public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function tenant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'abs_tenant_id');
    }

    public function industry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Industry::class, 'abs_industry_id');
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'abs_country_id');
    }

    public function broker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Broker::class, 'broker_id');
    }

    public function absShelter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shelter::class, 'abs_shelter_id');
    }

    public function absBroker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Broker::class, 'abs_broker_id');
    }
}
