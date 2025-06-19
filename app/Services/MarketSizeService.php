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
            ->with('market', 'subMarket', 'industrialPark', 'developer', 'buildingAvailable')
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
            ->when($validatedData['building_class'] ?? false, fn($q, $val) => $q->where('class', 'like', "%{$val}%"))
            ->when($validatedData['market'] ?? false, fn($q, $val) => $q->whereHas('market', fn($mq) => $mq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['sub_market'] ?? false, fn($q, $val) => $q->whereHas('subMarket', fn($sq) => $sq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['industrial_park'] ?? false, fn($q, $val) => $q->whereHas('industrialPark', fn($iq) => $iq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['developer'] ?? false, fn($q, $val) => $q->whereHas('developer', fn($dq) => $dq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['avl_type'] ?? false, fn($q, $val) => $q->where('avl_type', 'like', "%{$val}%"))
            ->groupBy('buildings.id')
            ->orderBy($sort_column, $sort)
            ->paginate($page_size, page: $page);
    }

}
