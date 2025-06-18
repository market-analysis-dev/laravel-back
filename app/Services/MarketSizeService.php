<?php

namespace App\Services;

use App\Models\Building;

class MarketSizeService
{

    public function filter(array $validatedData): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $page_size = $validatedData['page_size'] ?? 10;
        $page = $validatedData['page'] ?? 1;
        $sort_column = $validatedData['sort_column'] ?? 'id';
        $sort = $validatedData['sort'] ?? 'desc';

        return Building::query()
            ->with('market', 'subMarket', 'industrialPark', 'developer')
            ->when($validatedData['building_name'] ?? false, fn($q, $val) => $q->where('building_name', 'like', "%{$val}%"))
            ->when($validatedData['building_class'] ?? false, fn($q, $val) => $q->where('class', 'like', "%{$val}%"))
            ->when($validatedData['market'] ?? false, fn($q, $val) => $q->whereHas('market', fn($mq) => $mq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['sub_market'] ?? false, fn($q, $val) => $q->whereHas('subMarket', fn($sq) => $sq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['industrial_park'] ?? false, fn($q, $val) => $q->whereHas('industrialPark', fn($iq) => $iq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['developer'] ?? false, fn($q, $val) => $q->whereHas('developer', fn($dq) => $dq->where('name', 'like', "%{$val}%")))
            ->when($validatedData['avl_type'] ?? false, fn($q, $val) => $q->where('avl_type', 'like', "%{$val}%"))
            ->orderBy($sort_column, $sort)
            ->paginate($page_size, page: $page);
    }


}
