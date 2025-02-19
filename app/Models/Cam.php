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
        'submarket_id',
        'cam_building_sf',
        'cam_land_sf',
        'has_cam_services',
        'has_lightning_maintenance',
        'has_park_administration',
        'storm_sewer_maintenance',
        'has_survelliance',
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
        return $this->belongsTo(SubMarket::class, 'submarket_id');
    }
}
