<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class BuildingLog extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'buildings_log';

    protected $fillable = [
        'building_id',
        'region_id',
        'market_id',
        'sub_market_id',
        'builder_id',
        'industrial_park_id',
        'developer_id',
        'owner_id',
        'building_name',
        'building_size_sf',
        'latitud',
        'longitud',
        'year_built',
        'clear_height_ft',
        'total_land_sf',
        'offices_space_sf',
        'has_crane',
        'has_rail_spur',
        'has_leed',
        'hvac_production_area',
        'ventilation',
        'roof_system',
        'skylights_sf',
        'coverage',
        'kvas',
        'expansion_land',
        'class',
        'type_generation',
        'currency',
        'tenancy',
        'construction_type',
        'lightning',
        'fire_protection_system',
        'deal',
        'loading_door',
        'above_market_tis',
        'status',
        'columns_spacing_ft',
        'floor_thickness_in',
        'floor_resistance',
        'expansion_up_to_sf',
        'bay_size',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function market(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function subMarket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubMarket::class, 'sub_market_id');
    }

    public function builder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'builder_id');
    }

    public function industrialPark(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(IndustrialPark::class, 'industrial_park_id');
    }

    public function developer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'owner_id');
    }

    public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
}
