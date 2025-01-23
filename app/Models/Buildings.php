<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \App\Models\BuildingsAbsorption|null $buildingAbsorption
 * @property-read \App\Models\BuildingsAvailable|null $buildingAvailable
 * @property-read \App\Models\BuildingsContacts|null $buildingContacts
 * @property-read \App\Models\BuildingsFeatures|null $buildingFeatures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BuildingsImages> $buildingImages
 * @property-read int|null $building_images_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings query()
 * @property int $id
 * @property int $region_id
 * @property int $market_id
 * @property int $submarket_id
 * @property int $builder_id
 * @property int $industrial_park_id
 * @property int $developer_id
 * @property int $owner_id
 * @property int $user_owner_id
 * @property int|null $contact_id
 * @property string $building_name
 * @property string $class
 * @property int $building_size_sf
 * @property string $building_phase
 * @property string $type_generation
 * @property string $currency
 * @property string $tenancy
 * @property string $latitud
 * @property string $longitud
 * @property int|null $year_built
 * @property int|null $clear_height
 * @property string|null $total_land
 * @property int|null $offices_space
 * @property int $has_expansion_land
 * @property int $has_crane
 * @property int $has_hvac
 * @property int $has_rail_spur
 * @property int $has_sprinklers
 * @property int $has_office
 * @property int $has_leed
 * @property int $new_construction
 * @property int $starting_construction
 * @property string|null $hvac_production_area
 * @property string|null $construction_type
 * @property string|null $lightning
 * @property string|null $ventilation
 * @property string|null $transformer_capacity
 * @property string|null $construction_state
 * @property string|null $roof_system
 * @property string $fire_protection_system
 * @property string|null $skylights_sf
 * @property string|null $coverage
 * @property string|null $kvas
 * @property string $deal
 * @property string|null $loading_door
 * @property string|null $above_market_tis
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereAboveMarketTis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereBuilderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereBuildingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereBuildingPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereBuildingSizeSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereClearHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereConstructionState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereConstructionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereCoverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereFireProtectionSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasCrane($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasExpansionLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasHvac($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasLeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasRailSpur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHasSprinklers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereHvacProductionArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereIndustrialParkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereKvas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereLightning($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereLoadingDoor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereNewConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereOfficesSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereRoofSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereSkylightsSf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereStartingConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereSubMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereTenancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereTotalLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereTransformerCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereTypeGeneration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereUserOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereVentilation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereYearBuilt($value)
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereDeletedBy($value)
 * @property int $expansion_land
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereExpansionLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereSubmarketId($value)
 * @property string $columns_spacing
 * @property string $bay_size
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereBaySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buildings whereColumnsSpacing($value)
 * @mixin \Eloquent
 */
class Buildings extends Model
{
    use HasFactory;

    protected $table = 'buildings';

    protected $fillable = [
        'vo_bo',
        'builder_state_id',
        'sf_sm',
        'building_name',
        'class_id',
        'building_size_sf',
        'expansion_land',
        'status_id',
        'industrial_park_id',
        'type_id',
        'owner_id',
        'developer_id',
        'broker_id',
        'builder_id',
        'region_id',
        'market_id',
        'submarket_id',
        'deal_id',
        'currency_id',
        'sale_price_usd',
        'tenancy_id',
        'latitud',
        'longitud',
        'year_built',
        'clear_height',
        'offices_space',
        'crane',
        'hvac',
        'rail_spur',
        'sprinklers',
        'office',
        'leed',
        'total_land',
        'hvac_production_area',
        'createdAt',
        'modifiedAt',
        'status',
    ];

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    // Relaciones que deberían estar definidas en el modelo Buildings
    public function buildingAvailable()
    {
        return $this->hasOne(BuildingsAvailable::class, 'building_id');
    }

    public function buildingAbsorption()
    {
        return $this->hasOne(BuildingsAbsorption::class, 'building_id');
    }

    public function buildingContacts()
    {
        return $this->hasOne(BuildingsContacts::class, 'building_id');
    }

    public function buildingFeatures()
    {
        return $this->hasOne(BuildingsFeatures::class, 'building_id');
    }

    public function buildingImages()
    {
        return $this->hasMany(BuildingsImages::class, 'buildingId');
    }
}
