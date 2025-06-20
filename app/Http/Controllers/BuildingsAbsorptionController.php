<?php

namespace App\Http\Controllers;

use App\Enums\BuildingState;
use App\Enums\BuildingStatus;
use App\Http\Requests\ConvertToAvailableRequest;
use App\Http\Requests\ImportBuildingAbsorptionRequest;
use App\Http\Requests\IndexBuildingsAbsorptionRequest;
use App\Http\Requests\StoreBuildingWithAbsorptionRequest;
use App\Http\Requests\UpdateBuildingAbsorptionDraftRequest;
use App\Http\Requests\UpdateBuildingWithAbsorptionRequest;
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Responses\ApiResponse;
use App\Services\BuildingsAvailableService;
use App\Services\BuildingService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Services\BuildingAbsorptionImportService;

class BuildingsAbsorptionController extends ApiController implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:buildings.absorption.index', only: ['index']),
            new Middleware('permission:buildings.absorption.show', only: ['show']),
            new Middleware('permission:buildings.absorption.create', only: ['store']),
            new Middleware('permission:buildings.absorption.update', only: ['update']),
            new Middleware('permission:buildings.absorption.destroy', only: ['destroy']),
            new Middleware('permission:buildings.availability.to-available', only: ['toAvailable']),
        ];
    }

    public function __construct(
        private readonly BuildingsAvailableService $buildingAvailableService,
        private readonly BuildingService           $buildingService
    )
    {
    }

    /**
     * @param IndexBuildingsAbsorptionRequest $request
     * @param Building $building
     * @return ApiResponse
     */
    public function index(IndexBuildingsAbsorptionRequest $request): ApiResponse
    {
        $validated = $request->validated();
        $absorptions = $this->buildingAvailableService->filterAbsorption($validated);

        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

        return $this->success(data: $absorptions);
    }

    public function store(StoreBuildingWithAbsorptionRequest $request): ApiResponse
    {
        try {
            $validated = $request->validated();
            $buildingData = $validated['building'];
            $absorptionData = $validated['absorption'];
            $files = $request->file('files') ?? null;
            $fileType = $request->input('type');

            $building = $this->buildingService->createWithAbsorption($buildingData, $absorptionData, $files, $fileType);

            return $this->success('Created successfully', $building);
        } catch (\Throwable $e) {
            report($e);
            return $this->error(message: 'Error creating building with absorption', data: [], status: 500);
        }
    }

    /**
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function show(BuildingAvailable $buildingAbsorption): ApiResponse
    {
        if ($buildingAbsorption->building_state !== BuildingState::ABSORPTION->value) {
            return $this->error('Building Absorption not found', status: 404);
        }

        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

        return $this->success(data: [
            'building' => $buildingAbsorption->building,
            'absorption' => $buildingAbsorption
        ]);
    }


    public function update(UpdateBuildingWithAbsorptionRequest $request, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        try {
            $validated = $request->validated();
            $buildingData = $validated['building'];
            $availabilityData = $validated['absorption'];
            $files = $request->file('files') ?? null;
            $fileType = $request->input('type');

            if($buildingAbsorption->building_state !== BuildingState::ABSORPTION->value) {
                return $this->error('Building Absorption not found', status: 404);
            }

            if ($buildingAbsorption->building_id !== $buildingData['id']) {
                return $this->error('Building ID mismatch', status: 400);
            }

            $availabilityData['id'] = $buildingAbsorption->id;

            $result = $this->buildingService->updateWithAbsorption($buildingData, $availabilityData, $files, $fileType);

            return $this->success('Updated successfully', $result);
        } catch (\Throwable $e) {
            report($e);

            return $this->error(
                message: 'Error updating building with absorption',
                data: ['error' => $e->getMessage()],
                status: 500
            );
        }
    }

    /**
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function destroy(BuildingAvailable $buildingAbsorption): ApiResponse
    {
        if ($buildingAbsorption->building_state !== BuildingState::ABSORPTION->value) {
            return $this->error('Building Absorption not found', status: 404);
        }

        try {
            if ($buildingAbsorption->delete()) {
                return $this->success('Building Absorption deleted successfully', $buildingAbsorption);
            }
            return $this->error('Building Absorption delete failed', status: 422);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param ConvertToAvailableRequest $request
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function toAvailable(ConvertToAvailableRequest $request, Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        if ($buildingAbsorption->status === BuildingStatus::DRAFT->value) {
            return $this->error('Cannot convert from one draft.', status: 400);
        }
        $validated = $request->validated();
        if (!empty($validated['fire_protection_system']) && is_array($validated['fire_protection_system'])) {
            $validated['fire_protection_system'] = implode(',', $validated['fire_protection_system']);
        }
        if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
            $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
        }
        $result = $this->buildingAvailableService->convertToAvailable($validated, $building->id, $buildingAbsorption->id);
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
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function draft(Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        $result = $this->buildingAvailableService->createDraft($building, $buildingAbsorption, BuildingState::ABSORPTION->value);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function getDraft(Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        $result = $this->buildingAvailableService->getDraft($building, $buildingAbsorption, BuildingState::ABSORPTION->value);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);
    }

    /**
     * @param UpdateBuildingAbsorptionDraftRequest $request
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function updateDraft(UpdateBuildingAbsorptionDraftRequest $request, Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        $validated = $request->validated();
        $result = $this->buildingAvailableService->updateDraft($building, $buildingAbsorption, $validated, BuildingState::ABSORPTION->value);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);

    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAbsorption
     * @return ApiResponse
     */
    public function deleteDraft(Building $building, BuildingAvailable $buildingAbsorption): ApiResponse
    {
        $result = $this->buildingAvailableService->deleteDraft($building, $buildingAbsorption, BuildingState::ABSORPTION->value);
        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }
        return $this->success($result['success'], data: $result['data']);
    }


/**
 * @param ImportBuildingAbsorptionRequest $request
 * @param BuildingAbsorptionImportService $importService
 * @return ApiResponse
 */
public function importAbsorption(ImportBuildingAbsorptionRequest $request, BuildingAbsorptionImportService $importService): ApiResponse
{
    $request->validated();

    $file = $request->file('file');

    $result = $importService->importFromFile($file);

    return $this->success(
        message: "Import completed",
        data: $result);
}

}
