<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuildingsAvailableRequest;
use App\Http\Requests\UpdateBuildingsAvailableRequest;
use App\Models\BuildingAvailable;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class BuildingsAvailableController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $buildingsAvl = BuildingAvailable::all();
        return $this->success(data: $buildingsAvl);
    }


    public function store(StoreBuildingsAvailableRequest $request): ApiResponse
    {
        $building = BuildingAvailable::create($request->validated());
        return $this->success('Building Available created successfully', $building);
    }


    public function update(UpdateBuildingsAvailableRequest $request, BuildingAvailable $building): ApiResponse
    {
        try {
            if ($building->update($request->validated())) {
                return $this->success('Building Available updated successfully', $building);
            }

            return $this->error('Building Available update failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param BuildingAvailable $building
     * @return ApiResponse
     */
    public function destroy(BuildingAvailable $building): ApiResponse
    {
        try {
            if ($building->delete()) {
                return $this->success('Building Available deleted successfully', $building);
            }
            return $this->error('Building Available delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

}
