<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * 
 *
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Developer|null $developer
 * @property-read \App\Models\IndustrialPark|null $industrialPark
 * @property-read \App\Models\Market|null $market
 * @property-read \App\Models\Region|null $region
 * @property-read \App\Models\SubMarket|null $subMarket
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam withoutTrashed()
 * @property int $id
 * @property int|null $industrial_park_id
 * @property int|null $developer_id
 * @property int|null $region_id
 * @property int|null $market_id
 * @property int|null $sub_market_id
 * @property string|null $cam_building_sf
 * @property string|null $cam_land_sf
 * @property int $has_cam_services
 * @property int $has_lightning_maintenance
 * @property int $has_park_administration
 * @property int $storm_sewer_maintenance
 * @property int $has_surveillance
 * @property int $has_management_fee
 * @property string|null $currency
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereCamBuildingSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereCamLandSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereHasCamServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereHasLightningMaintenance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereHasManagementFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereHasParkAdministration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereHasSurveillance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereIndustrialParkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereStormSewerMaintenance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereSubMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cam whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Cam extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cams';

    protected $fillable = [
        'industrial_park_id',
        'developer_id',
        'region_id',
        'market_id',
        'sub_market_id',
        'cam_building_sf',
        'cam_land_sf',
        'has_cam_services',
        'has_lightning_maintenance',
        'has_park_administration',
        'storm_sewer_maintenance',
        'has_surveillance',
        'has_management_fee',
        'currency',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function industrialPark(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(IndustrialPark::class, 'industrial_park_id');
    }

    public function developer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

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
}
