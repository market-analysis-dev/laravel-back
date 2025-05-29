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
 * @property int $building_available_id
 * @property int $building_id
 * @property int|null $abs_tenant_id
 * @property int|null $abs_industry_id
 * @property int|null $abs_country_id
 * @property int $broker_id
 * @property int|null $abs_shelter_id
 * @property int|null $size_sf
 * @property string|null $avl_building_dimensions_ft
 * @property int|null $avl_minimum_space_sf
 * @property int|null $dock_doors
 * @property int|null $rams
 * @property int|null $truck_court_ft
 * @property int|null $shared_truck
 * @property int|null $new_construction
 * @property int|null $is_starting_construction
 * @property string|null $bay_size
 * @property string|null $avl_date
 * @property int|null $abs_lease_term_month
 * @property int|null $parking_space
 * @property int|null $trailer_parking_space
 * @property string|null $avl_min_lease
 * @property string|null $avl_max_lease
 * @property string|null $abs_closing_rate
 * @property string|null $abs_closing_date
 * @property string|null $abs_lease_up
 * @property string|null $abs_month
 * @property string|null $abs_sale_price
 * @property string $building_state
 * @property string|null $avl_type
 * @property string|null $abs_type
 * @property string|null $abs_final_use
 * @property string|null $abs_company_type
 * @property string $abs_deal
 * @property string $fire_protection_system
 * @property string|null $above_market_tis
 * @property int $is_negative_absorption
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Broker|null $absBroker
 * @property-read \App\Models\Shelter|null $absShelter
 * @property-read \App\Models\Broker $broker
 * @property-read \App\Models\Building $building
 * @property-read \App\Models\BuildingAvailable $buildingAvailable
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Industry|null $industry
 * @property-read \App\Models\Tenant|null $tenant
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAboveMarketTis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsFinalUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsLeaseTermMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsLeaseUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsShelterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlBuildingDimensionsFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlMaxLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlMinLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlMinimumSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereBuildingAvailableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereBuildingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereDockDoors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereFireProtectionSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereIsNegativeAbsorption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereIsStartingConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereNewConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereParkingSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereRams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereSharedTruck($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereTrailerParkingSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereTruckCourtFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog withoutTrashed()
 * @property int|null $ramps
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereRamps($value)
 * @property int|null $avl_knockout_docks
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlKnockoutDocks($value)
 * @property string $building_dimensions_ft
 * @property int $construction_size_sf
 * @property string|null $kvas_fees_paid
 * @property int|null $is_new_construction
 * @property string $abs_asking_shell
 * @property int $abs_closing_dock_door
 * @property int $abs_closing_knockout_docks
 * @property int $abs_closing_ramps
 * @property int $abs_closing_truck_court
 * @property string $abs_closing_currency
 * @property int $avl_sale_price
 * @property int $offices_space_sf
 * @property int|null $knockout_docks
 * @property string $avl_deal
 * @property int $has_tis_hvac
 * @property int $has_tis_crane
 * @property int $has_tis_rail_spur
 * @property int $has_tis_sprinklers
 * @property int $has_tis_crossdock
 * @property int $has_tis_office
 * @property int $has_tis_leed
 * @property int $has_tis_land_expansion
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsAskingShell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingDockDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingKnockoutDocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingRamps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAbsClosingTruckCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereAvlSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereBuildingDimensionsFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereConstructionSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisCrane($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisCrossdock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisHvac($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisLandExpansion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisLeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereHasTisSprinklers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereIsNewConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereKnockoutDocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereKvasFeesPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereOfficesSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableLog whereStatus($value)
 * @mixin \Eloquent
 */
class BuildingAvailableLog extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'buildings_available_log';

    protected $fillable = [
        'building_available_id',
        'building_id',
        'abs_tenant_id',
        'abs_industry_id',
        'abs_country_id',
        'broker_id',
        'abs_shelter_id',
        'building_available_id',
        'size_sf',
        'building_dimensions_ft',
        'avl_minimum_space_sf',
        'construction_size_sf',
        'dock_doors',
        'ramps',
        'truck_court_ft',
        'kvas_fees_paid',
        'shared_truck',
        'is_new_construction',
        'is_starting_construction',
        'bay_size',
        'avl_date',
        'abs_lease_term_month',
        'parking_space',
        'trailer_parking_space',
        'avl_min_lease',
        'avl_max_lease',
        'abs_asking_shell',
        'abs_closing_rate',
        'abs_closing_dock_door',
        'abs_closing_knockout_docks',
        'abs_closing_ramps',
        'abs_closing_truck_court',
        'abs_closing_currency',
        'avl_sale_price',
        'abs_closing_date',
        'abs_lease_up',
        'abs_month',
        'abs_sale_price',
        'offices_space_sf',
        'knockout_docks',
        'building_state',
        'avl_type',
        'abs_type',
        'abs_final_use',
        'abs_company_type',
        'abs_deal',
        'avl_deal',
        'fire_protection_system',
        'has_tis_hvac',
        'has_tis_crane',
        'has_tis_rail_spur',
        'has_tis_sprinklers',
        'has_tis_crossdock',
        'has_tis_office',
        'has_tis_leed',
        'has_tis_land_expansion',
        'is_negative_absorption',
        'status',
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

}
