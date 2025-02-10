<?php

namespace App\Http\Controllers;

use App\Enums\BuildingClass;
use App\Enums\BuildingDeal;
use App\Enums\BuildingFireProtectionSystem;
use App\Enums\BuildingLightning;
use App\Enums\BuildingLoadingDoor;
use App\Enums\BuildingPhase;
use App\Enums\BuildingTenancy;
use App\Enums\BuildingTypeConstruction;
use App\Enums\BuildingTypeGeneration;
use App\Enums\TechnicalImprovements;
use App\Enums\BuildingStatus;
use App\Http\Requests\IndexBuildingRequest;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Models\Building;
use App\Services\BuildingService;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use PDF;

class BuildingController extends ApiController
{
    private BuildingService $buildingService;

    public function __construct(BuildingService $buildingService)
    {
        $this->buildingService = $buildingService;
    }

    public function index(IndexBuildingRequest $request): ApiResponse
    {
        $buildings = $this->buildingService->filter($request->validated());
        return $this->success(data: $buildings);
    }

    public function store(StoreBuildingRequest $request): ApiResponse
    {
        $validated = $request->validated();

        if ($validated['sqftToM2'] ?? false) {
            $validated = $this->buildingService->convertMetrics($validated);
        }

        $building = $this->buildingService->create($validated);
        return $this->success('Building created successfully', $building);
    }

    public function show(Building $building): ApiResponse
    {
        $building = $this->buildingService->show($building);
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
            $validated = $request->validated();

            if ($validated['sqftToM2'] ?? false) {
                $validated = $this->buildingService->convertMetrics($validated);
            }

            $building = $this->buildingService->update($building, $validated);
            return $this->success('Building updated successfully', $building);

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
        $phases = BuildingPhase::array();

        $filteredPhases = collect($phases)
            ->when(request()->boolean('availability'), function ($collection) {
                return $collection->filter(fn($phase) => in_array($phase, [
                    BuildingPhase::CONSTRUCTION->value,
                    BuildingPhase::PLANNED->value,
                BuildingPhase::SUBLEASE->value,
                BuildingPhase::EXPIRATION->value,
            ]));
        })
            ->when(request()->boolean('absorption'), function ($collection) {
                return $collection->filter(fn($phase) => in_array($phase, [
                    BuildingPhase::BTS->value,
                    BuildingPhase::EXPANSION->value,
            ]));
        });

        return $this->success(data: $filteredPhases->values());
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
    public function listTypeGenerations(): ApiResponse
    {
        return $this->success(data: BuildingTypeGeneration::array());
    }

    /**
     * @return ApiResponse
     */
    public function listDeals(): ApiResponse
    {
        return $this->success(data: BuildingDeal::array());
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

    public function layoutDesign($buildingId)
    {
        return response()->make(
            $this->buildingService->layoutDesign($buildingId),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }
}
