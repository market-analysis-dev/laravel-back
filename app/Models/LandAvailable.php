<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property-read \App\Models\Developer|null $absBroker
 * @property-read \App\Models\Company|null $absCompany
 * @property-read \App\Models\Country|null $absCountry
 * @property-read \App\Models\Developer|null $avlBroker
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Land|null $land
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable withoutTrashed()
 * @property int $id
 * @property int $land_id
 * @property int|null $abs_company_id
 * @property int|null $avl_broker_id
 * @property int|null $abs_country_id
 * @property int|null $abs_broker_id
 * @property string $land_state
 * @property int|null $avl_size_sm
 * @property string|null $avl_land_sm
 * @property int|null $avl_minimum
 * @property string|null $avl_min_sale
 * @property string|null $avl_max_sale
 * @property string|null $avl_zoning
 * @property string|null $avl_pacel_shape
 * @property int|null $avl_rail_spur
 * @property int|null $avl_natural_gas
 * @property int|null $avl_sewage
 * @property int|null $avl_water
 * @property int|null $avl_electric
 * @property int|null $avl_conditioned_construction
 * @property int|null $avl_quarter
 * @property int|null $avl_year
 * @property string|null $land_condition
 * @property int|null $abs_size_HA
 * @property int|null $abs_quarter
 * @property int|null $abs_year
 * @property string|null $abs_closing_price
 * @property string|null $abs_type_buyer
 * @property string|null $abs_company_type
 * @property string|null $comments
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsClosingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsSizeHA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsTypeBuyer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAbsYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlBrokerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlConditionedConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlElectric($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlLandSm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlMaxSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlMinSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlMinimum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlNaturalGas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlPacelShape($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlSewage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlSizeSm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereAvlZoning($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereLandCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereLandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereLandState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandAvailable whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class LandAvailable extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'lands_available';

    protected $fillable = [
        'land_id',
        'abs_company_id',
        'avl_broker_id',
        'abs_country_id',
        'abs_broker_id',
        'land_state',
        'avl_size_sm',
        'avl_land_sm',
        'avl_minimum',
        'avl_min_sale',
        'avl_max_sale',
        'avl_zoning',
        'avl_pacel_shape',
        'avl_rail_spur',
        'avl_natural_gas',
        'avl_sewage',
        'avl_water',
        'avl_electric',
        'avl_conditioned_construction',
        'avl_quarter',
        'avl_year',
        'land_condition',
        'abs_size_HA',
        'abs_quarter',
        'abs_year',
        'abs_closing_price',
        'abs_type_buyer',
        'abs_company_type',
        'comments',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function land(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Land::class, 'land_id');
    }

    public function absCompany(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class, 'abs_company_id');
    }

    public function avlBroker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'avl_broker_id');
    }

    public function absCountry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'abs_country_id');
    }

    public function absBroker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'abs_broker_id');
    }

}
