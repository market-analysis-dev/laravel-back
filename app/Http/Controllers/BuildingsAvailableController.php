<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexBuildingsAvailableRequest;
use App\Http\Requests\StoreBuildingsAvailableRequest;
use App\Http\Requests\UpdateBuildingsAvailableRequest;
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Services\BuildingsAvailableService;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class BuildingsAvailableController extends ApiController
{
    /**
     * @param Request $request
     * @param Building $building
     * @return ApiResponse
     */

    private BuildingsAvailableService $buildingAvailableService;

    public function __construct(BuildingsAvailableService $buildingAvailableService)
    {
        $this->buildingAvailableService = $buildingAvailableService;
    }

    public function index(IndexBuildingsAvailableRequest $request, Building $building): ApiResponse
    {
        $validated = $request->validated();
        $availabilities = $this->buildingAvailableService->filterAvailable($validated, $building->id);

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
