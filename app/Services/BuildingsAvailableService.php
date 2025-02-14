<?php

namespace App\Services;

use App\Models\BuildingAvailable;
use App\Enums\BuildingState;

class BuildingsAvailableService
{
    /**
     * Create a new class instance.
     */
    public function filterAvailable(array $validatedData, int $buildingId)
    {
        $size = $validatedData['size'] ?? 10;
        $order = $validatedData['column'] ?? 'id';
        $direction = $validatedData['state'] ?? 'desc';

        return BuildingAvailable::where('building_id', $buildingId)
            ->where('building_state', '=', BuildingState::AVAILABILITY->value)
            ->when($validatedData['search'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('building_state', 'like', "%{$search}%")
                        ->orWhere('avl_size_sf', 'like', "%{$search}%")
                        ->orWhere('dock_doors', 'like', "%{$search}%");
                });
            })
            ->when($validatedData['avl_size_sf'] ?? false, function ($query, $avl_size_sf) {
                $query->where('avl_size_sf', 'like', "%{$avl_size_sf}%");
            })
            ->when($validatedData['avl_building_dimensions'] ?? false, function ($query, $avl_building_dimensions) {
                $query->where('avl_building_dimensions', 'like', "%{$avl_building_dimensions}%");
            })
            ->when($validatedData['avl_minimum_space_sf'] ?? false, function ($query, $avl_minimum_space_sf) {
                $query->where('avl_minimum_space_sf', 'like', "%{$avl_minimum_space_sf}%");
            })
            ->when($validatedData['avl_expansion_up_to_sf'] ?? false, function ($query, $avl_expansion_up_to_sf) {
                $query->where('avl_expansion_up_to_sf', 'like', "%{$avl_expansion_up_to_sf}%");
            })
            ->when($validatedData['dock_doors'] ?? false, function ($query, $dock_doors) {
                $query->where('dock_doors', 'like', "%{$dock_doors}%");
            })
            ->orderBy($order, $direction)
            ->paginate($size);
    }

    /**
     * @param array $validatedData
     * @param int $buildingId
     * @param int $buildingAbsorptionId
     * @return array
     */
    public function convertToAvailable(array $validatedData, int $buildingId, int $buildingAbsorptionId): array
    {
        $buildingAbsorption = BuildingAvailable::where('building_id', $buildingId)
            ->where('id', $buildingAbsorptionId)
            ->firstOrFail();

        if ($buildingAbsorption->building_state !== 'Absorption') {
            return [
                'success' => false,
                'message' => 'Only records with state "Absorption" can be converted to "Availability".',
                'code' => 400
            ];
        }

        $validatedData['building_state'] = 'Availability';

        $buildingAbsorption->update($validatedData);

        return [
            'success' => true,
            'data' => $buildingAbsorption
        ];


    }

    /**
     * @param array $validatedData
     * @param int $buildingId
     * @param int $buildingAvailableId
     * @return array|\Illuminate\Database\Eloquent\TModel
     */
    public function convertToAbsorption(array $validatedData, int $buildingId, int $buildingAvailableId) {
        $buildingAvailable = BuildingAvailable::where('building_id', $buildingId)
            ->where('id', $buildingAvailableId)
            ->firstOrFail();

        if ($buildingAvailable->building_state !== 'Availability') {
            return [
                'success' => false,
                'message' => 'Only records with state "Available" can be converted to "Absorption".',
                'code' => 400
            ];
        }

        $validatedData['building_state'] = 'Absorption';

        $buildingAvailable->update($validatedData);

        return [
            'success' => true,
            'data' => $buildingAvailable
        ];
    }

    public function create(array $validated): BuildingAvailable
    {
        return BuildingAvailable::create($validated);
    }

    public function update(BuildingAvailable $buildingAvailable, array $validated): BuildingAvailable
    {
        $buildingAvailable->update($validated);
        return $buildingAvailable;
    }

    public function convertMetrics(array $data): array
    {
        if (isset($data['size_sf'])) {
            $data['size_sf'] = $this->convertM2ToSqFt($data['size_sf']);
        }

        if (isset($data['truck_court_ft'])) {
            $data['truck_court_ft'] = $this->convertMToFt($data['truck_court_ft']);
        }

        if (isset($data['avl_minimum_space_sf'])) {
            $data['avl_minimum_space_sf'] = $this->convertM2ToSqFt($data['avl_minimum_space_sf']);
        }

        if (isset($data['avl_building_dimensions_ft'])) {
            $data['avl_building_dimensions_ft'] = $this->convertColumnsSpacingToFt($data['avl_building_dimensions_ft']);
        }

        if (isset($data['avl_min_lease'])) {
            $data['avl_min_lease'] = $this->convertUsdM2ToUsdSqft($data['avl_min_lease']);
        }

        if (isset($data['avl_max_lease'])) {
            $data['avl_max_lease'] = $this->convertUsdM2ToUsdSqft($data['avl_max_lease']);
        }

        if (isset($data['abs_closing_rate'])) {
            $data['abs_closing_rate'] = $this->convertUsdM2ToUsdSqft($data['abs_closing_rate']);
        }

        return $data;
    }

    public function convertM2ToSqFt(float $m2): int
    {
        return (int) round($m2 * 10.764);
    }

    public function convertMToFt(float $m): int
    {
        return (int) round($m * 3.281);
    }

    public function convertUsdM2ToUsdSqft(float $usdM2): int
    {
        return (int) round($usdM2 / 10.764);
    }

    public function convertColumnsSpacingToFt(string $spacing): string
    {
        $parts = explode('x', $spacing);
        $convertedParts = array_map(fn($value) => $this->convertMToFt((float) $value), $parts);
        return implode('x', $convertedParts);
    }


}
