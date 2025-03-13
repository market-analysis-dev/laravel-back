<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 
 *
 * @property int $id
 * @property int $region_id
 * @property int $market_id
 * @property int $sub_market_id
 * @property int $industrial_park_id
 * @property int $developer_id
 * @property int $owner_id
 * @property int|null $contact_id
 * @property string $land_name
 * @property string $currency
 * @property string $latitud
 * @property string $longitud
 * @property int $size_ha
 * @property string|null $kvas
 * @property string $zoning
 * @property string $parcel_shape
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Developer $developer
 * @property-read \App\Models\IndustrialPark $industrialPark
 * @property-read \App\Models\Market $market
 * @property-read \App\Models\Developer $owner
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\SubMarket $subMarket
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereIndustrialParkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereKvas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereLandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereParcelShape($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereSizeHa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereSubMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land whereZoning($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Land withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @mixin \Eloquent
 */
class Land extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'lands';

    protected $fillable = [
        'region_id',
        'market_id',
        'sub_market_id',
        'industrial_park_id',
        'developer_id',
        'owner_id',
        'contact_id',
        'land_name',
        'currency',
        'latitud',
        'longitud',
        'size_ha',
        'kvas',
        'zoning',
        'parcel_shape',
        'status',
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
        return $this->belongsTo(SubMarket::class, 'sub_market_id');
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

    public function industrialPark(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(IndustrialPark::class, 'industrial_park_id');
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'land_contacts', 'land_id', 'contact_id');
    }
}
