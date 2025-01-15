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
}
