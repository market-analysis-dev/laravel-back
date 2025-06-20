<?php

namespace App\Http\Controllers;

use App\Enums\BuildingState;
use App\Enums\BuildingStatus;
use App\Http\Requests\ConvertToAbsorptionRequest;
use App\Http\Requests\ImportBuildingAvailabilityRequest;
use App\Http\Requests\IndexBuildingsAvailableRequest;
use App\Http\Requests\StoreBuildingWithAvailabilityRequest;
use App\Http\Requests\UpdateBuildingAvailableDraftRequest;
use App\Http\Requests\UpdateBuildingWithAvailabilityRequest;
use App\Models\Broker;
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Models\Country;
use App\Models\Developer;
use App\Models\IndustrialPark;
use App\Models\Industry;
use App\Models\Market;
use App\Models\Region;
use App\Models\Shelter;
use App\Models\SubMarket;
use App\Models\Tenant;
use App\Responses\ApiResponse;
use App\Services\BuildingsAvailableService;
use App\Services\BuildingService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Services\BuildingAvailabilityImportService;

class BuildingsAvailableController extends ApiController implements HasMiddleware
{


    public static function middleware()
    {
        return [
            new Middleware('permission:buildings.availability.index', only: ['index']),
            new Middleware('permission:buildings.availability.show', only: ['show']),
            new Middleware('permission:buildings.availability.create', only: ['store']),
            new Middleware('permission:buildings.availability.update', only: ['update']),
            new Middleware('permission:buildings.availability.destroy', only: ['destroy']),
            new Middleware('permission:buildings.availability.to-absorption', only: ['toAbsorption']),
        ];
    }


    public function __construct(
        private readonly BuildingsAvailableService $buildingAvailableService,
        private readonly BuildingService           $buildingService,
    )
    {
    }

    public function index(IndexBuildingsAvailableRequest $request): ApiResponse
    {
        $validated = $request->validated();
        $availabilities = $this->buildingAvailableService->filterAvailable($validated);

        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

        return $this->success(data: $availabilities);
    }

    /**
     * @param StoreBuildingWithAvailabilityRequest $request
     * @return ApiResponse
     */
    public function store(StoreBuildingWithAvailabilityRequest $request): ApiResponse
    {
        try {
            $validated = $request->validated();
            $buildingData = $validated['building'];
            $availabilityData = $validated['availability'];

            $building = $this->buildingService->createWithAvailability($buildingData, $availabilityData);

            return $this->success('Created successfully', $building);
        } catch (\Throwable $e) {
            report($e);
            return $this->error(message: 'Error creating building with availability', data: [], status: 500);
        }
    }

    /**
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function show(BuildingAvailable $buildingAvailable): ApiResponse
    {
        if ($buildingAvailable->building_state !== BuildingState::AVAILABILITY->value) {
            return $this->error('Availability not found', status: 404);
        }
        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

        return $this->success(data: [
            'building' => $buildingAvailable->building,
            'availability' => $buildingAvailable
        ]);
    }


    /**
     * @param UpdateBuildingWithAvailabilityRequest $request
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function update(UpdateBuildingWithAvailabilityRequest $request, BuildingAvailable $buildingAvailable): ApiResponse
    {
        try {
            $validated = $request->validated();
            $buildingData = $validated['building'];
            $availabilityData = $validated['availability'];

            if ($buildingAvailable->building_state !== BuildingState::AVAILABILITY->value) {
                return $this->error('Building Availability not found', status: 404);
            }

            if ($buildingAvailable->building_id !== $buildingData['id']) {
                return $this->error('Building ID mismatch', status: 422);
            }

            $buildingData['id'] = $buildingAvailable->building_id;
            $availabilityData['id'] = $buildingAvailable->id;

            $result = $this->buildingService->updateWithAvailability($buildingData, $availabilityData);

            return $this->success('Updated successfully', $result);
        } catch (\Throwable $e) {
            report($e);

            return $this->error(
                message: 'Error updating building with availability',
                data: ['error' => $e->getMessage()],
                status: 500
            );
        }
    }

    /**
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function destroy(BuildingAvailable $buildingAvailable): ApiResponse
    {
        try {
            if ($buildingAvailable->delete()) {
                return $this->success('Building Available deleted successfully', $buildingAvailable);
            }
            return $this->error('Building Available delete failed', ['error_code' => 422]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), ['error_code' => 500]);
        }
    }

    /**
     * @param ConvertToAbsorptionRequest $request
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function toAbsorption(ConvertToAbsorptionRequest $request, Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        if ($buildingAvailable->status === BuildingStatus::DRAFT->value) {
            return $this->error('Cannot convert from one draft.', status: 400);
        }
        $validated = $request->validated();
        if (!empty($validated['fire_protection_system']) && is_array($validated['fire_protection_system'])) {
            $validated['fire_protection_system'] = implode(',', $validated['fire_protection_system']);
        }
        if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
            $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
        }
        $result = $this->buildingAvailableService->convertToAbsorption($validated, $building->id, $buildingAvailable->id);
        if (!$result['success']) {
            return $this->error($result['message'], ['error_code' => $result['code']]);
        }
        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

        return $this->success(data: $result['data']);
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function draft(Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        $result = $this->buildingAvailableService->createDraft($building, $buildingAvailable, BuildingState::AVAILABILITY->value);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);
    }


    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function getDraft(Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        $result = $this->buildingAvailableService->getDraft($building, $buildingAvailable, BuildingState::AVAILABILITY->value);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);
    }


    /**
     * @param UpdateBuildingAvailableDraftRequest $request
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function updateDraft(UpdateBuildingAvailableDraftRequest $request, Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        $validated = $request->validated();
        $result = $this->buildingAvailableService->updateDraft($building, $buildingAvailable, $validated, BuildingState::AVAILABILITY->value);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @return ApiResponse
     */
    public function deleteDraft(Building $building, BuildingAvailable $buildingAvailable): ApiResponse
    {
        $result = $this->buildingAvailableService->deleteDraft($building, $buildingAvailable, BuildingState::AVAILABILITY->value);
        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }
        return $this->success($result['success'], data: $result['data']);
    }


/**
 * @param ImportBuildingAvailabilityRequest $request
 * @param BuildingAvailabilityImportService $importService
 * @return ApiResponse
 */
    public function importAvailability(ImportBuildingAvailabilityRequest $request, BuildingAvailabilityImportService $importService): ApiResponse
    {
        $request->validated();

        $path = $request->file('file')->getRealPath();

        $result = $importService->importFromCsvPath($path);

        return $this->success("Import completed", data: $result);
    }


}
