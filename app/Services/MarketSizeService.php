<?php

namespace App\Services;

use App\Enums\BuildingState;
use App\Enums\BuildingType;
use App\Models\Building;
use Illuminate\Database\Eloquent\Builder;

class MarketSizeService
{

    public function filter(array $validatedData): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $page_size = $validatedData['page_size'] ?? 10;
        $page = $validatedData['page'] ?? 1;
        $sort_column = $validatedData['sort_column'] ?? 'buildings.id';
        $sort = $validatedData['sort'] ?? 'desc';

        return Building::query()
            ->select('buildings.*')
            ->join('buildings_available', 'buildings_available.building_id', '=', 'buildings.id')
            ->with('market', 'subMarket', 'industrialPark', 'developer', 'buildingAvailable', 'region', 'builder', 'owner', 'buildingAvailable.tenant', 'buildingAvailable.industry', 'buildingAvailable.country')
            ->where(function (Builder $query) {
                $query->where('buildings_available.is_starting_construction', true)
                    ->where('buildings_available.building_state', BuildingState::AVAILABILITY->value);
            })
            ->orWhere(function (Builder $query) {
                $query->whereIn('buildings_available.abs_type', [
                    BuildingType::BTS_EXPANSION->value,
                    BuildingType::BTS->value
                ])
                    ->where('buildings_available.is_starting_construction', true)
                    ->where('buildings_available.building_state', BuildingState::ABSORPTION->value);
            })
            ->when($validatedData['building_name'] ?? false, fn($q, $val) => $q->where('building_name', 'like', "%{$val}%"))
            ->when($validatedData['class'] ?? false, fn($q, $val) => $q->where('class', 'like', "%{$val}%"))
            ->when($validatedData['market'] ?? false, fn($q, $val) => $q->whereHas('market', fn($mq) => $mq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['submarket'] ?? false, fn($q, $val) => $q->whereHas('subMarket', fn($sq) => $sq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['industrial_park'] ?? false, fn($q, $val) => $q->whereHas('industrialPark', fn($iq) => $iq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['developer'] ?? false, fn($q, $val) => $q->whereHas('developer', fn($dq) => $dq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['builder'] ?? false, fn($q, $val) => $q->whereHas('builder', fn($bq) => $bq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['owner'] ?? false, fn($q, $val) => $q->whereHas('owner', fn($oq) => $oq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['region'] ?? false, fn($q, $val) => $q->whereHas('region', fn($rq) => $rq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['region_id'] ?? false, fn($q, $val) => $q->where('region_id', $val))
            ->when($validatedData['market_id'] ?? false, fn($q, $val) => $q->where('market_id', $val))
            ->when($validatedData['sub_market_id'] ?? false, fn($q, $val) => $q->where('sub_market_id', $val))
            ->when($validatedData['developer_id'] ?? false, fn($q, $val) => $q->where('developer_id', $val))
            ->when($validatedData['status'] ?? false, fn($q, $val) => $q->where('status', $val))
            ->when($validatedData['building_size_sf'] ?? false, fn($q, $val) => $q->where('building_size_sf', $val))
            ->when($validatedData['construction_size_sf'] ?? false, fn($q, $val) => $q->where('construction_size_sf', $val))
            ->when($validatedData['latitud'] ?? false, fn($q, $val) => $q->where('latitud', $val))
            ->when($validatedData['longitud'] ?? false, fn($q, $val) => $q->where('longitud', $val))
            ->when($validatedData['year_built'] ?? false, fn($q, $val) => $q->where('year_built', $val))
            ->when($validatedData['clear_height_ft'] ?? false, fn($q, $val) => $q->where('clear_height_ft', $val))
            ->when($validatedData['total_land_sf'] ?? false, fn($q, $val) => $q->where('total_land_sf', $val))
            ->when($validatedData['hvac_production_area'] ?? false, fn($q, $val) => $q->where('hvac_production_area', 'like', "%{$val}%"))
            ->when($validatedData['ventilation'] ?? false, fn($q, $val) => $q->where('ventilation', 'like', "%{$val}%"))
            ->when($validatedData['roofing'] ?? false, fn($q, $val) => $q->where('roofing', 'like', "%{$val}%"))
            ->when($validatedData['skylights_sf'] ?? false, fn($q, $val) => $q->where('skylights_sf', $val))
            ->when($validatedData['coverage'] ?? false, fn($q, $val) => $q->where('coverage', 'like', "%{$val}%"))
            ->when($validatedData['transformer_capacity'] ?? false, fn($q, $val) => $q->where('transformer_capacity', 'like', "%{$val}%"))
            ->when($validatedData['expansion_land'] ?? false, fn($q, $val) => $q->where('expansion_land', 'like', "%{$val}%"))
            ->when($validatedData['columns_spacing_ft'] ?? false, fn($q, $val) => $q->where('columns_spacing_ft', $val))
            ->when($validatedData['floor_thickness_in'] ?? false, fn($q, $val) => $q->where('floor_thickness_in', $val))
            ->when($validatedData['floor_resistance'] ?? false, fn($q, $val) => $q->where('floor_resistance', 'like', "%{$val}%"))
            ->when($validatedData['expansion_up_to_sf'] ?? false, fn($q, $val) => $q->where('expansion_up_to_sf', $val))
            ->when($validatedData['generation'] ?? false, fn($q, $val) => $q->where('generation', 'like', "%{$val}%"))
            ->when($validatedData['currency'] ?? false, fn($q, $val) => $q->where('currency', 'like', "%{$val}%"))
            ->when($validatedData['tenancy'] ?? false, fn($q, $val) => $q->where('tenancy', 'like', "%{$val}%"))
            ->when($validatedData['construction_type'] ?? false, fn($q, $val) => $q->where('construction_type', 'like', "%{$val}%"))
            ->when($validatedData['lightning'] ?? false, fn($q, $val) => $q->where('lightning', 'like', "%{$val}%"))
            ->when($validatedData['loading_door'] ?? false, fn($q, $val) => $q->where('loading_door', 'like', "%{$val}%"))
            ->when($validatedData['building_type'] ?? false, fn($q, $val) => $q->where('building_type', 'like', "%{$val}%"))
            ->when($validatedData['certifications'] ?? false, fn($q, $val) => $q->where('certifications', 'like', "%{$val}%"))
            ->when($validatedData['owner_type'] ?? false, fn($q, $val) => $q->where('owner_type', 'like', "%{$val}%"))

            ->when($validatedData['type_avl'] ?? false, fn($q, $val) => $q->where('buildings_available.avl_type', 'like', "%{$val}%"))
            ->when($validatedData['type_abs'] ?? false, fn($q, $val) => $q->where('buildings_available.abs_type', 'like', "%{$val}%"))
            ->when($validatedData['tenant'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable.tenant', fn($tq) => $tq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['avl_size_sf'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('size_sf', $val)))
            ->when($validatedData['avl_minimum_space_sf'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('avl_minimum_space_sf', $val)))
            ->when($validatedData['offices_space_sf'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('offices_space_sf', $val)))
            ->when($validatedData['dock_doors'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('dock_doors', 'like', "%{$val}%")))
            ->when($validatedData['ramps'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('ramps', 'like', "%{$val}%")))
            ->when($validatedData['kvas_fees_paid'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('kvas_fees_paid', 'like', "%{$val}%")))
            ->when($validatedData['fire_protection_system'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('fire_protection_system', 'like', "%{$val}%")))
            ->when($validatedData['deal'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('abs_deal', 'like', "%{$val}%")->orWhere('avl_deal', 'like', "%{$val}%")))
            ->when($validatedData['avl_month'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->whereAvlDateType('month', $val)))
            ->when($validatedData['avl_quarter'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->whereAvlDateType('quarter', $val)))
            ->when($validatedData['avl_year'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->whereAvlDateType('year', $val)))
            ->when($validatedData['abs_closing_month'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->whereClosingDate('month', $val)))
            ->when($validatedData['abs_closing_quarter'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->whereClosingDate('quarter', $val)))
            ->when($validatedData['abs_closing_year'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->whereClosingDate('year', $val)))
            ->when($validatedData['abs_industry'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable.industry', fn($iq) => $iq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['abs_final_use'] ?? false, fn($q, $val) => $q->where('abs_final_use', 'like', "%{$val}%"))
            ->when($validatedData['abs_country'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable.country', fn($cq) => $cq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['abs_closing_currency'] ?? false, fn($q, $val) => $q->whereHas('buildingAvailable', fn($aq) => $aq->where('abs_closing_currency', 'like', "%{$val}%")))
            ->when($validatedData['abs_company_type'] ?? false, fn($q, $val) => $q->where('abs_company_type', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_hvac'] ?? false, fn($q, $val) => $q->where('has_tis_hvac', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_office'] ?? false, fn($q, $val) => $q->where('has_tis_office', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_crane'] ?? false, fn($q, $val) => $q->where('has_tis_crane', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_rail_spur'] ?? false, fn($q, $val) => $q->where('has_tis_rail_spur', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_sprinklers'] ?? false, fn($q, $val) => $q->where('has_tis_sprinklers', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_crossdock'] ?? false, fn($q, $val) => $q->where('has_tis_crossdock', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_leed'] ?? false, fn($q, $val) => $q->where('has_tis_leed', 'like', "%{$val}%"))
            ->when($validatedData['has_tis_land_expansion'] ?? false, fn($q, $val) => $q->where('has_tis_land_expansion', 'like', "%{$val}%"))
            ->when($validatedData['is_new_construction'] ?? false, fn($q, $val) => $q->where('is_new_construction', 'like', "%{$val}%"))
            ->when($validatedData['is_starting_construction'] ?? false, fn($q, $val) => $q->where('is_starting_construction', 'like', "%{$val}%"))

            ->groupBy('buildings.id')
            ->orderBy($sort_column, $sort)
            ->paginate($page_size, page: $page);
    }

}
