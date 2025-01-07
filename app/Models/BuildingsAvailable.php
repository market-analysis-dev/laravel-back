<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable query()
 * @property int $id
 * @property int $building_id
 * @property int $abs_tenant_id
 * @property int $abs_industry_id
 * @property int $abs_country_id
 * @property int $broker_id
 * @property string $building_state
 * @property int $avl_size_sf
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsAskingRateShell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsClosingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsFinalUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsLeaseTermMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsLeaseUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAbsTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlBuildingDimensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlExpansionUpToSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlMaxLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlMinLease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlMinimumSpaceSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereAvlSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereBuildingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereColumnsSpacing($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereDockDoors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereDriveInDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereFloorResistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereFloorThickness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereHasCrossdock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereIsStartingConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereKnockoutsDocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereNewConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereParkingSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereSharedTruck($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereTruckCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsAvailable whereUpdatedBy($value)
 * @mixin \Eloquent
 */
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
