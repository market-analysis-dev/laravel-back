<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuildingsAbsorptionRequest;
use App\Http\Requests\UpdateBuildingsAbsorptionRequest;
use App\Models\Building;
use App\Models\BuildingAvailable;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class BuildingsAbsorptionController extends ApiController
{
    /**
     * @param Request $request
     * @param Building $building
     * @return ApiResponse
     */
    public function index(Request $request, Building $building): ApiResponse
    {
        $absorptions = BuildingAvailable::where('building_id', $building->id)
            ->where('building_state', '=', 'Absorption')
            ->paginate(10);

        return $this->success(data: $absorptions);
    }


    /**
     * @param StoreBuildingsAbsorptionRequest $request
     * @param Building $building
     * @return ApiResponse
     */
    public function store(StoreBuildingsAbsorptionRequest $request, Building $building): ApiResponse
    {
        $data = $request->validated();
        $data['building_id'] = $building->id;

        $absorption = BuildingAvailable::create($data);

        return $this->success('Building Absorption created successfully', $absorption);
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function show(Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        if ($buildingAbsorption->building_id !== $building->id) {
            return $this->error('Building Absorption not found for this Building', ['error_code' => 404]);
        }

        if ($buildingAbsorption->building_state !== 'Absorption') {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        return $this->success(data: $buildingAbsorption);
    }


    /**
     * @param UpdateBuildingsAbsorptionRequest $request
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function update(UpdateBuildingsAbsorptionRequest $request, Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        if ($buildingAbsorption->building_id !== $building->id) {
            return $this->error('Building Absorption not found for this Building', ['error_code' => 404]);
        }
        if ($buildingAbsorption->building_state !== 'Absorption') {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        try {
            $buildingAbsorption->update($request->validated());
            return $this->success('Building Absorption updated successfully', $buildingAbsorption);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function destroy(Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        if ($buildingAbsorption->building_id !== $building->id) {
            return $this->error('Building Absorption not found for this Building', ['error_code' => 404]);
        }

        if ($buildingAbsorption->building_state !== 'Absorption') {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        try {
            if ($buildingAbsorption->delete()) {
                return $this->success('Building Absorption deleted successfully', $buildingAbsorption);
            }
            return $this->error('Building Absorption delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }




}
