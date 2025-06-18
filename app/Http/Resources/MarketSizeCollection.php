<?php

namespace App\Http\Resources;

use App\Models\Building;
use App\Models\IndustrialPark;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MarketSizeCollection extends ResourceCollection
{
    /**

     * The resource that this resource collects.

     *

     * @var string

     */

    public $collects = Building::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var Building $this */

        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'region' => RegionResource::make($this->whenLoaded('region')),
            'market_id' => $this->market_id,
            'market'=> MarketResource::make($this->whenLoaded('market')),
            'sub_market_id' => $this->sub_market_id,
            'sub_market' => SubMarketResource::make($this->whenLoaded('sub_market')),
            'builder_id' => $this->builder_id,
            'builder' => BuilderResource::make($this->whenLoaded('builder')),
            'industrial_park_id' => $this->industrial_park_id,
            'industrial_park' => IndustrialPark::make($this->whenLoaded('industrialPark')),
            'developer_id' => $this->developer_id,
            'developer' => DeveloperResource::make($this->whenLoaded('developer')),
            'owner_id' => $this->owner_id,
            'owner' => OwnerResource::make($this->whenLoaded('owner')),
            'building_name' => $this->building_name,
            'building_size_sf' => $this->building_size_sf,
            'construction_size_sf' => $this->building_size_sf,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'year_built' => $this->year_built,
            'clear_height_ft' => $this->clear_height_ft,
            'total_land_sf' => $this->total_land_sf,
            'hvac_production_area' => $this->hvac_production_area,
            'ventilation' => $this->ventilation,
            'roofing' => $this->roofing,
            'skylights_sf' => $this->skylights_sf,
            'coverage' => $this->coverage,
            'transformer_capacity' => $this->transformer_capacity,
            'expansion_land' => $this->expansion_land,
            'columns_spacing_ft' => $this->columns_spacing_ft,
            'floor_thickness_in' => $this->floor_thickness_in,
            'floor_resistance' => $this->floor_resistance,
            'expansion_up_to_sf' => $this->expansion_up_to_sf,
            'class' => $this->class,
            'generation' => $this->generation,
            'currency' => $this->currency,
            'tenancy' => $this->tenancy,
            'construction_type' => $this->construction_type,
            'lightning' => $this->lightning,
            'loading_door' => $this->loading_door,
            'building_type' => $this->building_type,
            'certifications' => $this->certifications,
            'owner_type' => $this->owner_type,
            'stage' => $this->stage,
            'type_avl' => $this->buildingsAvailable[0]->avl_type,
            'type_abs' => $this->buildingsAvailable->map(fn($ba) => $ba->abs_type)->implode(', '),
            'buildingsAvailable' => $this->buildingsAvailable,

        ];
    }
}
