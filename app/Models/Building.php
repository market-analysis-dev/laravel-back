<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 
 *
 * @property int $id
 * @property int $region_id
 * @property int $market_id
 * @property int $submarket_id
 * @property int $builder_id
 * @property int $industrial_park_id
 * @property int $developer_id
 * @property int $owner_id
 * @property int|null $contact_id
 * @property string $building_name
 * @property int $building_size_sf
 * @property string $latitud
 * @property string $longitud
 * @property int|null $year_built
 * @property int|null $clear_height_ft
 * @property int|null $total_land_sf
 * @property int|null $offices_space_sf
 * @property int $has_expansion_land
 * @property int $has_crane
 * @property int $has_hvac
 * @property int $has_rail_spur
 * @property int $has_sprinklers
 * @property int $has_office
 * @property int $has_leed
 * @property string|null $hvac_production_area
 * @property string|null $ventilation
 * @property string|null $transformer_capacity
 * @property string|null $construction_state
 * @property string|null $roof_system
 * @property string|null $skylights_sf
 * @property string|null $coverage
 * @property string|null $kvas
 * @property int $expansion_land
 * @property string $class
 * @property string $type_generation
 * @property string $currency
 * @property string $tenancy
 * @property string|null $construction_type
 * @property string|null $lightning
 * @property string $fire_protection_system
 * @property string $deal
 * @property string|null $loading_door
 * @property string|null $above_market_tis
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Developer $builder
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BuildingAvailable> $buildingsAvailable
 * @property-read int|null $buildings_available_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Developer $developer
 * @property-read \App\Models\IndustrialPark $industrialPark
 * @property-read \App\Models\Market $market
 * @property-read \App\Models\Developer $owner
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\SubMarket $subMarket
 * @property-read \App\Models\User|null $updater
 * @property-read \App\Models\Developer $userOwner
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereAboveMarketTis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereBuilderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereBuildingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereBuildingSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereClearHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereConstructionState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereConstructionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereCoverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereExpansionLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereFireProtectionSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasCrane($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasExpansionLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasHvac($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasLeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHasSprinklers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereHvacProductionArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereIndustrialParkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereKvas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereLightning($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereLoadingDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereOfficesSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereRoofSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereSkylightsSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereSubmarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereTenancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereTotalLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereTransformerCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereTypeGeneration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereUserOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereVentilation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereYearBuilt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building withoutTrashed()
 * @property string $columns_spacing
 * @property string $bay_size
 * @property int $floor_thickness
 * @property string $floor_resistance
 * @property int $expansion_up_to_sf
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereColumnsSpacing($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereExpansionUpToSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereFloorResistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Building whereFloorThickness($value)
 * @mixin \Eloquent
 */
class Building extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'buildings';

    protected $fillable = [
        'region_id',
        'market_id',
        'submarket_id',
        'builder_id',
        'industrial_park_id',
        'developer_id',
        'owner_id',
        'contact_id',
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
        return $this->belongsTo(SubMarket::class, 'submarket_id');
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


    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function buildingsAvailable(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BuildingAvailable::class, 'building_id');
    }
}
