<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * 
 *
 * @property int $id
 * @property int $building_id
 * @property int $owner_id
 * @property int $developer_id
 * @property int $builder_id
 * @property int $industrial_park_id
 * @property int $region_id
 * @property int $market_id
 * @property int $sub_market_id
 * @property int $size_sf
 * @property string $deal
 * @property string $type
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $comments
 * @property string|null $latitude
 * @property string|null $longitude
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereBuilderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereIndustrialParkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereSubMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MarketGrowth withoutTrashed()
 * @mixin \Eloquent
 */
class MarketGrowth extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'market_growths';

    protected $fillable = [
        'building_id',
        'owner_id',
        'developer_id',
        'builder_id',
        'industrial_park_id',
        'region_id',
        'market_id',
        'sub_market_id',
        'size_sf',
        'deal',
        'type',
        'start_date',
        'end_date',
        'comments',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Developer::class, 'owner_id');
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function builder(): BelongsTo
    {
        return $this->belongsTo(Developer::class, 'builder_id');
    }

    public function industrialPark(): BelongsTo
    {
        return $this->belongsTo(IndustrialPark::class, 'industrial_park_id');
    }

    public function region():BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function subMarket(): BelongsTo
    {
        return $this->belongsTo(SubMarket::class, 'sub_market_id');
    }
}
