<?php

namespace App\Http\Resources;

use App\Enums\BuildingState;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketSizeResource extends JsonResource
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
            'region' => $this->region?->name,
            'market' => $this->market?->name,
            'sub_market' => $this->subMarket?->name,
            'builder' => $this->builder?->name,
            'industrial_park' => $this->industrialPark?->name,
            'developer' => $this->developer?->name,
            'owner' => $this->owner?->name,
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
            'type_avl' => $this->buildingsAvailable->filter(fn($ba) => $ba->building_state == BuildingState::AVAILABILITY->value)->map(fn($ba) => $ba->type)->implode(', '),
            'type_abs' => $this->buildingsAvailable->map(fn($ba) => $ba->abs_type)->implode(', '),
            'tenant' => $this->buildingsAvailable->count() > 1 ? $this->building_name : $this->buildingsAvailable[0]->tenant?->name,
            'avl_size_sf' => $this->buildingsAvailable->filter(fn($ba) => $ba->size_sf > 0 && $ba->building_state == BuildingState::AVAILABILITY->value)->sum('size_sf'),
            'avl_minimum_space_sf' => $this->buildingsAvailable[0]->avl_minimum_space_sf ?? 0,
        ];
    }
}
