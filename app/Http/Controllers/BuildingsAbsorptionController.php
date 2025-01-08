<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuildingsAbsorptionRequest;
use App\Models\BuildingAvailable;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class BuildingsAbsorptionController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $absorption = BuildingAvailable::where('building_state', '=', 'Absorption')->paginate(10);
        return $this->success(data: $absorption);
    }



    public function store(StoreBuildingsAbsorptionRequest $request): ApiResponse
    {
        $availability = BuildingAvailable::create($request->validated());
        return $this->success('Building Available created successfully', $availability);
    }


    public function show(BuildingAvailable $availability): ApiResponse
    {
        if ($availability->trashed()) {
            return $this->error('Building not found', ['error_code' => 404]);
        }

        return $this->success(data: $availability);
    }


    /**
     * @param UpdateBuildingsAvailableRequest $request
     * @param BuildingAvailable $availability
     * @return ApiResponse
     */
    public function update(UpdateBuildingsAvailableRequest $request, BuildingAvailable $availability): ApiResponse
    {
        try {
            if ($availability->update($request->validated())) {
                return $this->success('Building Available updated successfully', $availability);
            }

            return $this->error('Building Available update failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param BuildingAvailable $availability
     * @return ApiResponse
     */
    public function destroy(BuildingAvailable $availability): ApiResponse
    {
        try {
            if ($availability->delete()) {
                return $this->success('Building Available deleted successfully', $availability);
            }
            return $this->error('Building Available delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }



}
