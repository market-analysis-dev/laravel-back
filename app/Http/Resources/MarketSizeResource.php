<?php

namespace App\Http\Resources;

use App\Enums\BuildingState;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

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
        $avl = $this->buildingsAvailable->filter(fn($ba) => $ba->building_state == BuildingState::AVAILABILITY->value)->values();
        $avlCount = $avl->count();
        $abs = $this->buildingsAvailable->filter(fn($ba) => $ba->building_state == BuildingState::ABSORPTION->value)->values();
        $absCount = $abs->count();

        return [
            'id' => $this->id,
            'region' => $this->region?->name, //
            'market' => $this->market?->name, //
            'sub_market' => $this->subMarket?->name, //
            'builder' => $this->builder?->name, //
            'industrial_park' => $this->industrialPark?->name, //
            'developer' => $this->developer?->name, //
            'owner' => $this->owner?->name, //
            'building_name' => $this->building_name, //
            'building_size_sf' => $this->building_size_sf,
            'construction_size_sf' => $this->building_size_sf, //
            'latitud' => $this->latitud, //
            'longitud' => $this->longitud, //
            'year_built' => $this->year_built, //
            'clear_height_ft' => $this->clear_height_ft, //
            'total_land_sf' => $this->total_land_sf, //
            'hvac_production_area' => $this->hvac_production_area,
            'ventilation' => $this->ventilation, //
            'roofing' => $this->roofing, //
            'skylights_sf' => $this->skylights_sf, //
            'coverage' => $this->coverage, //
            'transformer_capacity' => $this->transformer_capacity,//
            'expansion_land' => $this->expansion_land,
            'columns_spacing_ft' => $this->columns_spacing_ft,
            'floor_thickness_in' => $this->floor_thickness_in, //
            'floor_resistance' => $this->floor_resistance, //
            'expansion_up_to_sf' => $this->expansion_up_to_sf, //
            'class' => $this->class,//
            'generation' => $this->generation, //
            'currency' => $this->currency,
            'tenancy' => $this->tenancy, //
            'construction_type' => $this->construction_type, //
            'lightning' => $this->lightning, //
            'loading_door' => $this->loading_door,//
            'building_type' => $this->building_type,
            'certifications' => $this->certifications,//
            'owner_type' => $this->owner_type, //
            'status' => $this->stage, //
            'type_avl' => $avlCount == 1 ? $avl[0]->avl_type : 'Pending',
            'type_abs' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->abs_type : 'Pending'),
            'tenant' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->tenant : 'Pending'),
            'avl_size_sf' => $avlCount  > 1 ? $avl->sum('size_sf') : ($avlCount == 1 ? $avl[0]->size_sf : 0), // Por si hay más de una disponibilidad
            'avl_minimum_space_sf' => $avlCount > 1 ? $avl->min('avl_minimum_space_sf') : ($avlCount == 1 ? $avl[0]->minimum_space_sf : 0), // Solo debe haber un mínimo
            'offices_space_sf' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->offices_space_sf ?? 0),
            'dock_doors' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->dock_doors ?? 0),
            'ramps' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->ramps ?? 0),
            'kvas_fees_paid' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : $this->buildingsAvailable[0]?->kvas_fees_paid ?? 'Pending',
            'fire_protection_system' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable->map(fn($ba) => $ba->fire_protection_system)->implode(', ')),
            'shared_trunk' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->shared_trunk ?? 'Pending'),
            'deal' => $avlCount + $absCount > 1 ? 'Multitenant' : ($avlCount == 1 ? $avl[0]->deal : ($absCount == 1 ? $abs[0]->deal : 'Pending')),
            'avl_month' => $avlCount == 1 ? $avl[0]->avl_month : 'Pending',
            'avl_quarter' => $avlCount == 1 ? $avl[0]->avl_quarter : 'Pending',
            'avl_year' => $avlCount == 1 ? $avl[0]->avl_year : 'Pending',
            'abs_closing_month' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->closing_month : 'Pending'),
            'abs_closing_quarter' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->closing_quarter : 'Pending'),
            'abs_closing_year' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->closing_year : 'Pending'),
            'abs_industry' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->industry?->name ?? 'Pending' : 'Pending'),
            'abs_final_use' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->abs_final_use ?? 'Pending' : 'Pending'),
            'abs_country' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->country?->name ?? 'Pending' : 'Pending'),
            'abs_closing_currency' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->abs_closing_currency ?? 'Pending' : 'Pending'),
            'abs_company_type' => $absCount > 1 ? 'Multitenant' : ($absCount == 1 ? $abs[0]->abs_company_type ?? 'Pending' : 'Pending'),
            'has_tis_hvac' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : $this->buildingsAvailable[0]?->has_tis_hvac ?? 'Pending',
            'has_tis_office' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_office ?? 'Pending'),
            'has_tis_crane' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_crane ?? 'Pending'),
            'has_tis_rail_spur' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_rail_spur ?? 'Pending'),
            'has_tis_sprinklers' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_sprinklers ?? 'Pending'),
            'has_tis_crossdock' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_crossdock ?? 'Pending'),
            'has_tis_leed' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_leed ?? 'Pending'),
            'has_tis_land_expansion' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->has_tis_land_expansion ?? 'Pending'),
            'is_new_construction' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->is_new_construction ?? 'Pending'),
            'is_starting_construction' => $this->buildingsAvailable->count() > 1 ? 'Multitenant' : ($this->buildingsAvailable[0]?->is_starting_construction ?? 'Pending'),
            'action' => [
                'type' => $this->tenancy == 'Single' ? 'link' : 'modal',
                'to' => $this->tenancy == 'Single' ? ($avlCount == 1 ? 'avl' : 'abs') : '',
                'id' => $this->tenancy == 'Single' ? ($avlCount == 1 ? $avl[0]->id : ($absCount == 1 ? $abs[0]->id : '')) : $this->id,
            ]
        ];
    }
}
