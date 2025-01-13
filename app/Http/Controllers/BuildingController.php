<?php

namespace App\Http\Controllers;

use App\Enums\BuildingClass;
use App\Enums\BuildingFireProtectionSystem;
use App\Enums\BuildingLightning;
use App\Enums\BuildingLoadingDoor;
use App\Enums\BuildingPhase;
use App\Enums\BuildingTenancy;
use App\Enums\BuildingTypeConstruction;
use App\Enums\BuildingTypeGeneration;
use App\Enums\TechnicalImprovements;
use App\Enums\BuildingStatus;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Models\Building;
use App\Responses\ApiResponse;

class BuildingController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $buildings = Building::paginate(10);
        return $this->success(data: $buildings);
    }


    /**
     * @param StoreBuildingRequest $request
     * @return ApiResponse
     */
    public function store(StoreBuildingRequest $request): ApiResponse
    {
        $building = Building::create($request->validated());
        return $this->success('Building created successfully', $building);
    }


    /**
     * @param Building $building
     * @return ApiResponse
     */
    public function show(Building $building): ApiResponse
    {
        if ($building->trashed()) {
            // return $this->error('Building not found', ['error_code' => 404]);
            return $this->error('Building not found', status:404);
        }

        return $this->success(data: $building);
    }


    /**
     * @param UpdateBuildingRequest $request
     * @param Building $building
     * @return ApiResponse
     */
    public function update(UpdateBuildingRequest $request, Building $building): ApiResponse
    {
        try {
            if ($building->update($request->validated())) {
                return $this->success('Building updated successfully', $building);
            }

            return $this->error('Building update failed', status:423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }

    /**
     * @param Building $building
     * @return ApiResponse
     */
    public function destroy(Building $building): ApiResponse
    {
        try {
            if ($building->delete()) {
                return $this->success('Building deleted successfully', $building);
            }
            // return $this->error('Building delete failed', ['error_code' => 423]);
            return $this->error('Building delete failed', status:423);
        } catch (\Exception $e) {
            // return $this->error($e->getMessage(), ['error_code' => 500]);
            return $this->error($e->getMessage(), status:500);
        }
    }

    /**
     * @return ApiResponse
     */
    public function listClasses(): ApiResponse
    {

        return $this->success(data: BuildingClass::array());
    }

    /**
     * @return ApiResponse
     */
    public function listLoadingDoors(): ApiResponse
    {
        return $this->success(data: BuildingLoadingDoor::array());
    }

    /**
     * @return ApiResponse
     */
    public function listPhases(): ApiResponse
    {
        return $this->success(data: BuildingPhase::array());
    }

    /**
     * @return ApiResponse
     */
    public function listLightnings(): ApiResponse
    {
        return $this->success(data: BuildingLightning::array());
    }


    /**
     * @return ApiResponse
     */
    public function listFireProtectionSystems(): ApiResponse
    {
        return $this->success(data: BuildingFireProtectionSystem::array());
    }

    /**
     * @return ApiResponse
     */
    public function listTenancies(): ApiResponse
    {
        return $this->success(data: BuildingTenancy::array());
    }

    /**
     * @return ApiResponse
     */
    public function listTypeConstructions(): ApiResponse
    {
        return $this->success(data: BuildingTypeConstruction::array());
    }

    /**
     * @return ApiResponse
     */
    public function listDeals(): ApiResponse
    {
        return $this->success(data: BuildingTypeConstruction::array());
    }

    /**
     * @return ApiResponse
     */
    public function listTechnicalImprovements(): ApiResponse
    {
        return $this->success(data: TechnicalImprovements::array());
    }

    /**
     * @return ApiResponse
     */
    public function listBuildingsStatus(): ApiResponse
    {
        return $this->success(data: BuildingStatus::array());
    }
}