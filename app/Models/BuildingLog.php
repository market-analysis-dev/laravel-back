<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 *
 *
 * @property int $id
 * @property int $building_id
 * @property int $region_id
 * @property int $market_id
 * @property int $sub_market_id
 * @property int $builder_id
 * @property int $industrial_park_id
 * @property int $developer_id
 * @property int $owner_id
 * @property string $building_name
 * @property int $building_size_sf
 * @property string $latitud
 * @property string $longitud
 * @property int|null $year_built
 * @property int|null $clear_height_ft
 * @property int|null $total_land_sf
 * @property int|null $offices_space_sf
 * @property int $has_crane
 * @property int $has_rail_spur
 * @property int $has_leed
 * @property string|null $hvac_production_area
 * @property string|null $ventilation
 * @property string|null $roof_system
 * @property string|null $skylights_sf
 * @property string|null $coverage
 * @property string|null $kvas
 * @property int $expansion_land
 * @property string $columns_spacing_ft
 * @property string $bay_size
 * @property int $floor_thickness_in
 * @property string $floor_resistance
 * @property int $expansion_up_to_sf
 * @property string $class
 * @property string $generation
 * @property string $currency
 * @property string $tenancy
 * @property string|null $construction_type
 * @property string|null $lightning
 * @property string $deal
 * @property string|null $loading_door
 * @property string $status
 * @property string $fire_protection_system
 * @property string|null $above_market_tis
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Developer $builder
 * @property-read \App\Models\Building $building
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Developer $developer
 * @property-read \App\Models\IndustrialPark $industrialPark
 * @property-read \App\Models\Market $market
 * @property-read \App\Models\Developer $owner
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\SubMarket $subMarket
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereAboveMarketTis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereBuilderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereBuildingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereBuildingSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereClearHeightFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereColumnsSpacingFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereConstructionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereCoverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereExpansionLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereExpansionUpToSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereFireProtectionSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereFloorResistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereFloorThicknessIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereHasCrane($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereHasLeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereHasRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereHvacProductionArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereIndustrialParkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereKvas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereLightning($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereLoadingDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereOfficesSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereRoofSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereSkylightsSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereSubMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereTenancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereTotalLandSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereTypeGeneration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereVentilation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog whereYearBuilt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingLog withoutTrashed()
 * @mixin \Eloquent
 */
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
        'building_id',
        'building_name',
        'building_size_sf',
        'latitud',
        'longitud',
        'year_built',
        'clear_height_ft',
        'total_land_sf',
        'hvac_production_area',
        'ventilation',
        'roof_system',
        'skylights_sf',
        'coverage',
        'transformer_capacity',
        'expansion_land',
        'class',
        'generation',
        'currency',
        'tenancy',
        'construction_type',
        'lightning',
        'fire_protection_system',
        'deal',
        'loading_door',
        'status',
        'building_type',
        'certifications',
        'columns_spacing_ft',
        'floor_thickness_in',
        'floor_resistance',
        'expansion_up_to_sf',
        'bay_size',
        'owner_type',
        'stage',
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
