<?php


namespace App\Services;


use App\Models\BuildingAvailable;

class ClientBuildingAvailabilityService
{
    public function filter(array $filters)
    {
        $query = BuildingAvailable::query()
            ->where('buildings_available.building_state', 'Availability')
            ->where('buildings_available.status', 'Enabled')
            ->join('buildings', 'buildings.id', '=', 'buildings_available.building_id')
            ->select('buildings_available.*', 'buildings.*');

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    protected function applyFilters($query, $filters): void
    {
        $filterIn = function (string $dbField, ?string $requestKey = null) use ($filters, $query) {
            $key = $requestKey ?? $dbField;

            if (!empty($filters[$key])) {
                $query->whereIn($dbField, (array) $filters[$key]);
            }
        };

        $filterLike = function (string $dbField, string $requestKey) use ($filters, $query) {
            if (!empty($filters[$requestKey])) {
                $query->where($dbField, 'like', '%' . $filters[$requestKey] . '%');
            }
        };

        $filterExact = function (string $dbField, string $requestKey) use ($filters, $query) {
            if (isset($filters[$requestKey])) {
                $query->where($dbField, $filters[$requestKey]);
            }
        };

        $filterMultiRange = function ($field, $param) use ($filters, $query) {
            if (!empty($filters[$param]) && is_array($filters[$param])) {
                $query->where(function ($q) use ($filters, $param, $field) {
                    foreach ($filters[$param] as $range) {
                        if (is_array($range) && count($range) === 2) {
                            [$from, $to] = $range;
                            if (is_numeric($from) && is_numeric($to)) {
                                $q->orWhereBetween($field, [$from, $to]);
                            } elseif (is_numeric($from)) {
                                $q->orWhere($field, '>=', $from);
                            } elseif (is_numeric($to)) {
                                $q->orWhere($field, '<=', $to);
                            }
                        }
                    }
                });
            }
        };


        $filterIn('buildings.market_id', 'market_id');
        $filterIn('buildings.sub_market_id', 'sub_market_id');
        $filterIn('buildings.class', 'class');
        $filterIn('buildings.deal', 'deal');
        $filterIn('buildings.generation', 'generation');
        $filterIn('buildings.currency', 'currency');
        $filterIn('buildings.tenancy', 'tenancy');
        $filterIn('buildings.industrial_park_id', 'industrial_park_id');
        $filterIn('buildings_available.shared_truck', 'shared_truck');
        $filterIn('buildings.loading_door', 'loading_door');
        $filterIn('buildings.developer_id', 'developer_id');
        $filterIn('buildings.owner_id', 'owner_id');
        $filterIn('buildings.owner_type', 'owner_type');
        $filterIn('buildings_available.avl_type', 'avl_type');
        $filterIn('buildings_available.above_market_tis', 'above_market_tis');
        $filterMultiRange('buildings_available.size_sf', 'size_sf');
        $filterMultiRange('buildings.clear_height_ft', 'clear_height_ft');
        $filterIn('buildings.building_name', 'building_name');
    }


}
