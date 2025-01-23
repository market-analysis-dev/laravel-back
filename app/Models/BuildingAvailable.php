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
 * @property int $abs_tenant_id
 * @property int $abs_industry_id
 * @property int $abs_country_id
 * @property int $broker_id
 * @property string $building_state
 * @property int $size_sf
 * @property string $avl_building_dimensions
 * @property string $avl_building_phase
 * @property string $abs_building_phase
 * @property int|null $avl_minimum_space_sf
 * @property int|null $avl_expansion_up_to_sf
 * @property int|null $dock_doors
 * @property int|null $drive_in_door
 * @property int|null $floor_thickness
 * @property string|null $floor_resistance
 * @property int|null $truck_court
 * @property int|null $has_crossdock
 * @property int|null $shared_truck
 * @property int|null $new_construction
 * @property int|null $is_starting_construction
 * @property string|null $bay_size
 * @property string|null $columns_spacing
 * @property string|null $avl_date
 * @property int|null $abs_lease_term_month
 * @property int|null $knockouts_docks
 * @property int|null $parking_space
 * @property string $avl_min_lease
 * @property string $avl_max_lease
 * @property string $abs_asking_rate_shell
 * @property string $abs_closing_rate
 * @property string|null $abs_closing_date
 * @property string|null $abs_lease_up
 * @property string|null $abs_month
 * @property string|null $abs_final_use
 * @property string|null $abs_company_type
 * @property string|null $abs_sale_price
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsAskingRateShell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsClosingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsFinalUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsLeaseTermMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsLeaseUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlBuildingDimensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlExpansionUpToSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlMaxLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlMinLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlMinimumSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAvlSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereBuildingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereColumnsSpacing($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDockDoors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDriveInDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereFloorResistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereFloorThickness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasCrossdock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereIsStartingConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereKnockoutsDocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereNewConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereParkingSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereSharedTruck($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereTruckCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereUpdatedBy($value)
 * @property-read \App\Models\BuildingContact $broker
 * @property-read \App\Models\Building $building
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\Industry $industry
 * @property-read \App\Models\Tenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable withoutTrashed()
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDeletedBy($value)
 * @property int|null $abs_shelter_id
 * @property int|null $abs_broker_id
 * @property int $has_expansion_land
 * @property int $has_crane
 * @property int $has_hvac
 * @property int $has_rail_spur
 * @property int $has_sprinklers
 * @property int $has_office
 * @property int $has_leed
 * @property string $deal
 * @property string $currency
 * @property-read \App\Models\Developer|null $absBroker
 * @property-read \App\Models\Shelter|null $absShelter
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereAbsShelterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasCrane($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasExpansionLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasHvac($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasLeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereHasSprinklers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailable whereSizeSf($value)
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
        'abs_shelter_id',
        'abs_country_id',
        'broker_id',
        'building_state',
        'size_sf',
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
        'deal',
        'currency',
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
        return $this->belongsTo(BuildingContact::class, 'broker_id');
    }

    public function absShelter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shelter::class, 'abs_shelter_id');
    }

    public function absBroker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'abs_broker_id');
    }
}
