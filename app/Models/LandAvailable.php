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
