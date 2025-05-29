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
 * @property int $building_id
 * @property int|null $abs_tenant_id
 * @property int|null $abs_industry_id
 * @property int|null $abs_country_id
 * @property int $broker_id
 * @property int|null $abs_shelter_id
 * @property int|null $building_available_id
 * @property int $size_sf
 * @property string $building_dimensions_ft
 * @property int $avl_minimum_space_sf
 * @property int $construction_size_sf
 * @property int $dock_doors
 * @property int $ramps
 * @property int $truck_court_ft
 * @property string|null $kvas_fees_paid
 * @property int|null $shared_truck
 * @property int|null $is_new_construction
 * @property int|null $is_starting_construction
 * @property string|null $bay_size
 * @property string|null $avl_date
 * @property int|null $abs_lease_term_month
 * @property int $parking_space
 * @property int $trailer_parking_space
 * @property string $avl_min_lease
 * @property string $avl_max_lease
 * @property string $abs_asking_shell
 * @property string $abs_closing_rate
 * @property int $abs_closing_dock_door
 * @property int $abs_closing_knockout_docks
 * @property int $abs_closing_ramps
 * @property int $abs_closing_truck_court
 * @property string $abs_closing_currency
 * @property int $avl_sale_price
 * @property string|null $abs_closing_date
 * @property string|null $abs_lease_up
 * @property string|null $abs_month
 * @property string|null $abs_sale_price
 * @property int $offices_space_sf
 * @property int|null $knockout_docks
 * @property string $building_state
 * @property string|null $avl_type
 * @property string|null $abs_type
 * @property string|null $abs_final_use
 * @property string|null $abs_company_type
 * @property string $abs_deal
 * @property string $avl_deal
 * @property string|null $fire_protection_system
 * @property int $has_tis_hvac
 * @property int $has_tis_crane
 * @property int $has_tis_rail_spur
 * @property int $has_tis_sprinklers
 * @property int $has_tis_crossdock
 * @property int $has_tis_office
 * @property int $has_tis_leed
 * @property int $has_tis_land_expansion
 * @property int $is_negative_absorption
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Shelter|null $absShelter
 * @property-read \App\Models\Broker $broker
 * @property-read \App\Models\Building $building
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Industry|null $industry
 * @property-read \App\Models\Tenant|null $tenant
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsAskingShell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingDockDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingKnockoutDocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingRamps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingTruckCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsFinalUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsLeaseTermMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsLeaseUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsShelterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlMaxLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlMinLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlMinimumSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBuildingAvailableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBuildingDimensionsFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBuildingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereConstructionSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDockDoors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereFireProtectionSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisCrane($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisCrossdock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisHvac($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisLandExpansion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisLeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasTisSprinklers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereIsNegativeAbsorption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereIsNewConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereIsStartingConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereKnockoutDocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereKvasFeesPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereOfficesSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereParkingSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereRamps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereSharedTruck($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereTrailerParkingSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereTruckCourtFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable withoutTrashed()
 * @mixin \Eloquent
 */
class BuildingAvailable extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'buildings_available';

    protected $fillable = [
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
