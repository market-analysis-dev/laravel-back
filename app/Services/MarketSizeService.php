<?php

namespace App\Services;

use App\Enums\BuildingState;
use App\Enums\BuildingStatus;
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Models\BuildingLog;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MarketSizeService
{
    /**
     * Get the market size data.
     *
     * @param array $filters
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function filter(array $filters): array
    {
        // Validate filters if necessary
        $this->validateFilters($filters);

        // Fetch market size data based on filters
        $data = Building::query()
            ->when(isset($filters['region_id']), function ($query) use ($filters) {
                return $query->where('region_id', $filters['region_id']);
            })
            ->when(isset($filters['market_id']), function ($query) use ($filters) {
                return $query->where('market_id', $filters['market_id']);
            })
            ->when(isset($filters['sub_market_id']), function ($query) use ($filters) {
                return $query->where('sub_market_id', $filters['sub_market_id']);
            })
            ->when(isset($filters['developer_id']), function ($query) use ($filters) {
                return $query->where('developer_id', $filters['developer_id']);
            })
            ->when(isset($filters['industrial_park_id']), function ($query) use ($filters) {
                return $query->where('industrial_park_id', $filters['industrial_park_id']);
            })
            ->when(isset($filters['building_id']), function ($query) use ($filters) {
                return $query->where('id', $filters['building_id']);
            })
            ->get();

        return $data->toArray();
    }

    /**
     * Validate the filters.
     *
     * @param array $filters
     * @throws ValidationException
     */
    protected function validateFilters(array $filters): void
    {


    }

}
