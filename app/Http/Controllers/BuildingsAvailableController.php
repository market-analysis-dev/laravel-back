<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuildingsAvailableRequest;
use App\Http\Requests\UpdateBuildingsAvailableRequest;
use App\Models\Building;
use App\Models\BuildingAvailable;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class BuildingsAvailableController extends ApiController
{
    /**
     * @param Request $request
     * @param Building $building
     * @return ApiResponse
     */
    public function index(Request $request, Building $building): ApiResponse
    {
        $validated = $request->validate([
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable',

            'building_state' => 'nullable',
            'avl_size_sf' => 'nullable',
            'avl_building_dimensions' => 'nullable',
            'avl_minimum_space_sf' => 'nullable',
            'avl_expansion_up_to_sf' => 'nullable',
            'dock_doors' => 'nullable',

            'column' => 'nullable|in:building_state,avl_size_sf,avl_building_dimensions,avl_minimum_space_sf,avl_expansion_up_to_sf,dock_doors',
            'state' => 'nullable|in:asc,desc',
        ]);

        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        $availabilities = BuildingAvailable::where('building_id', $building->id)
        ->where('building_state', '=', 'Availability')
        ->when($validated['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('building_state', 'like', "%{$search}%")
                    ->orWhere('avl_size_sf', 'like', "%{$search}%")
                    ->orWhere('dock_doors', 'like', "%{$search}%");
            });
        })
        ->when($validated['avl_size_sf'] ?? false, function ($query, $avl_size_sf) {
            $query->where('avl_size_sf', 'like', "%{$avl_size_sf}%");
        })
        ->when($validated['avl_building_dimensions'] ?? false, function ($query, $avl_building_dimensions) {
            $query->where('avl_building_dimensions', 'like', "%{$avl_building_dimensions}%");
        })
        ->when($validated['avl_minimum_space_sf'] ?? false, function ($query, $avl_minimum_space_sf) {
            $query->where('avl_minimum_space_sf', 'like', "%{$avl_minimum_space_sf}%");
        })
        ->when($validated['avl_expansion_up_to_sf'] ?? false, function ($query, $avl_expansion_up_to_sf) {
            $query->where('avl_expansion_up_to_sf', 'like', "%{$avl_expansion_up_to_sf}%");
        })
        ->when($validated['dock_doors'] ?? false, function ($query, $dock_doors) {
            $query->where('dock_doors', 'like', "%{$dock_doors}%");
        })
        ->orderBy($order, $direction)
        ->paginate($size);

        return $this->success(data: $availabilities);
    }


    /**
     * @param StoreBuildingsAvailableRequest $request
     * @param Building $building
     * @return ApiResponse
     */
    public function store(StoreBuildingsAvailableRequest $request, Building $building): ApiResponse
    {
        $data = $request->validated();
        $data['building_id'] = $building->id;

        $availability = BuildingAvailable::create($data);

        return $this->success('Building Available created successfully', $availability);
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function show(Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return $this->error('Building Available not found for this Building', ['error_code' => 404]);
        }

        if ($buildingAvailable->building_state !== 'Availability') {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        return $this->success(data: $buildingAvailable);
    }


    /**
     * @param UpdateBuildingsAvailableRequest $request
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function update(UpdateBuildingsAvailableRequest $request, Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return $this->error('Building Available not found for this Building', ['error_code' => 404]);
        }
        if ($buildingAvailable->building_state !== 'Availability') {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        try {
            $buildingAvailable->update($request->validated());
            return $this->success('Building Available updated successfully', $buildingAvailable);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function destroy(Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return $this->error('Building Available not found for this Building', ['error_code' => 404]);
        }

        if ($buildingAvailable->building_state !== 'Availability') {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        try {
            if ($buildingAvailable->delete()) {
                return $this->success('Building Available deleted successfully', $buildingAvailable);
            }
            return $this->error('Building Available delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


}
