<?php

namespace App\Services;

use App\Models\Building;

class BuildingService
{
    /**
     * Create a new class instance.
     */
    public function filter(array $validated): mixed
    {
        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        return Building::with(['market', 'subMarket', 'industrialPark'])
            ->when($validated['search'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search){
                    $query->where('status', 'like', "%{$search}%")
                        ->orWhere('building_name', 'like', "%{$search}%");
                });
            })
            ->when($validated['status'] ?? false, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($validated['building_name'] ??  false, function ($query, $building_name){
                $query->where('building_name', 'like', "%{$building_name}%");
            })
            ->when($validated['marketName'] ?? false, function ($query, $marketName) {
                $query->whereHas('market', function ($query) use ($marketName) {
                    $query->where('name', 'like', "%{$marketName}%");
                });
            })
            ->when($validated['submarketName'] ?? false, function ($query, $submarketName){
                $query->whereHas('subMarket', function ($query) use ($submarketName) {
                    $query->where('name', 'like', "%{$submarketName}%");
                });
            })
            ->when($validated['industrialParkName'] ?? false, function ($query, $industrialParkName) {
                $query->whereHas('industrialPark', function ($query) use ($industrialParkName) {
                    $query->where('name', 'like', "%{$industrialParkName}%");
                });
            })
            ->orderBy($order, $direction)
            ->paginate($size);
    }

    public function show(Building $building): Building
    {
        return $building->load([
            'region',
            'market',
            'subMarket',
            'builder',
            'industrialPark',
            'developer',
            'owner',
            'userOwner',
            'contact',
            'buildingsAvailable',
        ]);
    }

    public function create(array $validated): Building
    {
        return Building::create($validated);
    }

    public function update(Building $building, array $validated): Building
    {
        $building->update($validated);
        return $building;
    }

    public function convertMetrics(array $data): array
    {
        if (isset($data['building_size_sf'])) {
            $data['building_size_sf'] = $this->convertM2ToSqFt($data['building_size_sf']);
        }

        if (isset($data['total_land_sf'])) {
            $data['total_land_sf'] = $this->convertM2ToSqFt($data['total_land_sf']);
        }

        if (isset($data['clear_height_ft'])) {
            $data['clear_height_ft'] = $this->convertMToFt($data['clear_height_ft']);
        }

        if (isset($data['floor_thickness_in'])) {
            $data['floor_thickness_in'] = $this->convertInToCm($data['floor_thickness_in']);
        }

        if (isset($data['offices_space_sf'])) {
            $data['offices_space_sf'] = $this->convertM2ToSqFt($data['offices_space_sf']);
        }

        if (isset($data['columns_spacing_ft'])) {
            $data['columns_spacing_ft'] = $this->convertColumnsSpacingToFt($data['columns_spacing_ft']);
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

    public function convertInToCm(float $in): int
    {
        return (int) round($in * 2.54);
    }

    public function convertColumnsSpacingToFt(string $spacing): string
    {
        $parts = explode('x', $spacing);
        $convertedParts = array_map(fn($value) => $this->convertMToFt((float) $value), $parts);
        return implode('x', $convertedParts);
    }
}
