<?php


namespace App\Services;


use App\Models\BuildingAvailable;
use App\Enums\BuildingState;
use App\Enums\BuildingStatus;

class ClientBuildingAvailabilityService
{
    public function filter(array $filters)
    {
        $query = BuildingAvailable::query()
            ->where('buildings_available.building_state', BuildingState::AVAILABILITY->value)
            ->where('buildings_available.status', BuildingStatus::ENABLED->value)
            ->join('buildings', 'buildings.id', '=', 'buildings_available.building_id')
            ->join('cat_markets', 'cat_markets.id', '=', 'buildings.market_id')
            ->join('cat_sub_markets', 'cat_sub_markets.id', '=', 'buildings.sub_market_id')
            ->join('cat_developers as developer', 'developer.id', '=', 'buildings.developer_id')
            ->join('cat_developers as owner', 'owner.id', '=', 'buildings.owner_id')
            ->join('cat_developers as builder', 'builder.id', '=', 'buildings.builder_id')
            ->join('industrial_parks', 'industrial_parks.id', '=', 'buildings.industrial_park_id')
            ->join('cat_brokers', 'cat_brokers.id', '=', 'buildings_available.broker_id')
            ->select(
                'buildings_available.*',
                'buildings.*',
                'cat_markets.name as market_name',
                'cat_sub_markets.name as sub_market_name',
                'developer.name as developer_name',
                'owner.name as owner_name',
                'builder.name as builder_name',
                'industrial_parks.name as industrial_park_name',
                'cat_brokers.name as broker_name'
            );

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    public function filterStatistic(array $filters)
    {
        $query = BuildingAvailable::query()
            ->where('buildings_available.building_state', 'Availability')
            ->where('buildings_available.status', 'Enabled')
            ->join('buildings', 'buildings.id', '=', 'buildings_available.building_id')
            ->leftJoin('cat_regions', 'cat_regions.id', '=', 'buildings.region_id')
            ->select(
                'buildings_available.id',
                'buildings_available.size_sf',
                'buildings_available.status',
                'buildings.region_id',
                'buildings_available.building_id',
                'buildings.class',
                'buildings.stage',
                'buildings_available.building_state',
                'cat_regions.name as region_name',
                'cat_regions.id as region_id'
            );

        $this->applyFiltersStatistic($query, $filters);

        $results = $query->get();

        $totalBuildings = $results->sum('size_sf');
        $totalBuildingsCount = $results->count();

        $totalA = $results->where('class', 'A')->sum('size_sf');
        $totalB = $results->where('class', 'B')->sum('size_sf');
        $totalC = $results->where('class', 'C')->sum('size_sf');

        $totalACount = $results->where('class', 'A')->count();
        $totalBCount = $results->where('class', 'B')->count();
        $totalCCount = $results->where('class', 'C')->count();

        $totalPercentA = $totalBuildings > 0 ? round(($totalA / $totalBuildings) * 100, 2) : 0;
        $totalPercentB = $totalBuildings > 0 ? round(($totalB / $totalBuildings) * 100, 2) : 0;
        $totalPercentC = $totalBuildings > 0 ? round(($totalC / $totalBuildings) * 100, 2) : 0;

        $totalUnderConstruction = $results
            ->where('stage', 'Construction')
            ->sum('size_sf');

        $totalUnderConstructionCount = $results
            ->where('stage', 'Construction')
            ->count();

        $totalUnderConstructionPercent = $totalUnderConstruction > 0 ? round(($totalUnderConstruction / $totalBuildings) * 100, 2) : 0;

        $totalByLocations = $results->groupBy('region_id')
            ->map(function ($group) use ($totalBuildings) {
                $first = $group->first();
                $total = $group->sum('size_sf');

                return [
                    'state_id' => $first->region_id,
                    'state_name' => $first->region_name,
                    'total' => $total,
                    'percent' => $totalBuildings > 0 ? round(($total / $totalBuildings) * 100, 2) : 0,
                ];
            })->values();

        return [
            'total_buildings' => $totalBuildings,
            'total_buildings_count' => $totalBuildingsCount,
            'total_class_a' => $totalA,
            'total_class_a_count' => $totalACount,
            'total_percent_a' => $totalPercentA,
            'total_class_b' => $totalB,
            'total_class_b_count' => $totalBCount,
            'total_percent_b' => $totalPercentB,
            'total_class_c' => $totalC,
            'total_class_c_count' => $totalCCount,
            'total_percent_c' => $totalPercentC,
            'total_underconstruction' => $totalUnderConstruction,
            'total_underconstruction_count' => $totalUnderConstructionCount,
            'total_percent_underconstruction' => $totalUnderConstructionPercent,
            'total_by_locations' => $totalByLocations,
        ];

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
                $values = is_array($filters[$requestKey]) ? $filters[$requestKey] : [$filters[$requestKey]];

                $query->where(function ($q) use ($dbField, $values) {
                    foreach ($values as $value) {
                        $q->orWhere($dbField, 'like', '%' . $value . '%');
                    }
                });
            }
        };

        $filterExact = function (string $dbField, string $requestKey) use ($filters, $query) {
            if (isset($filters[$requestKey])) {
                $query->where($dbField, $filters[$requestKey]);
            }
        };

        /*$filterMultiRange = function ($field, $param) use ($filters, $query) {
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
        };*/
        $filterMultiRange = function ($field, $param) use ($filters, $query) {
            if (!empty($filters[$param])) {
                $ranges = $filters[$param];

                // Преобразуем [0 => 1, 1 => 2] в [[1, 2]]
                if (array_is_list($ranges) && count($ranges) === 2 && is_numeric($ranges[0]) && is_numeric($ranges[1])) {
                    $ranges = [ $ranges ];
                }

                if (is_array($ranges)) {
                    $query->where(function ($q) use ($ranges, $field) {
                        foreach ($ranges as $range) {
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
            }
        };



        $filterIn('buildings.market_id', 'market_id');
        $filterIn('buildings.sub_market_id', 'sub_market_id');
        $filterIn('buildings.class', 'class');
        $filterIn('buildings.deal', 'deal');
        $filterIn('buildings.generation', 'generation');
        $filterIn('buildings.currency', 'currency');
        $filterIn('buildings.tenancy', 'tenancy');
        $filterExact('buildings.latitud', 'latitud');
        $filterExact('buildings.longitud', 'longitud');
        $filterIn('buildings.industrial_park_id', 'industrial_park_id');
        $filterExact('buildings_available.shared_truck', 'shared_truck');
        $filterIn('buildings.loading_door', 'loading_door');
        $filterIn('buildings.developer_id', 'developer_id');
        $filterIn('buildings.owner_id', 'owner_id');
        $filterIn('buildings.owner_type', 'owner_type');
        $filterIn('buildings_available.avl_type', 'avl_type');
        $filterIn('buildings_available.above_market_tis', 'above_market_tis');
        $filterMultiRange('buildings_available.size_sf', 'size_sf');
        $filterMultiRange('buildings.clear_height_ft', 'clear_height_ft');
        $filterLike('buildings.building_name', 'building_name');
    }

    protected function applyFiltersStatistic($query, array $filters): void
    {
        $this->applyFilters($query, $filters);
    }


}
