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
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Responses\ApiResponse;
use App\Services\BuildingsAvailableService;
use App\Services\BuildingService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
 * @return ApiResponse
 */
    public function importAvailability(ImportBuildingAvailabilityRequest $request): ApiResponse
    {
    $request->validated();

    $path = $request->file('file')->getRealPath();
    $csv = array_map('str_getcsv', file($path));
    $header = array_map('trim', array_shift($csv));

    $importedBuildings = 0;
    $updatedBuildings = 0;
    $importedAvailability = 0;
    $updatedAvailability = 0;

    $normalizeNulls = function (&$data) {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $this($value);
            } else {
                if (is_string($value) && strtoupper($value) === 'NULL') {
                    $value = null;
                }
            }
        }
    };

    foreach ($csv as $row) {
        $data = array_combine($header, $row);

        if (empty($data['id']) || empty($data['ba_avl_date'])) {
            continue;
        }

        $buildingData = [
            'region_id' => $data['region_id'] ?? null,
            'market_id' => $data['market_id'] ?? null,
            'sub_market_id' => $data['sub_market_id'] ?? null,
            'builder_id' => $data['builder_id'] ?? null,
            'industrial_park_id' => $data['industrial_park_id'] ?? null,
            'developer_id' => $data['developer_id'] ?? null,
            'owner_id' => $data['owner_id'] ?? null,
            'building_name' => $data['building_name'] ?? null,
            'building_size_sf' => $data['building_size_sf'] ?? null,
            'latitud' => $data['latitud'] ?? null,
            'longitud' => $data['longitud'] ?? null,
            'year_built' => $data['year_built'] ?? null,
            'clear_height_ft' => $data['clear_height_ft'] ?? null,
            'total_land_sf' => $data['total_land_sf'] ?? null,
            'hvac_production_area' => $data['hvac_production_area'] ?? null,
            'ventilation' => $data['ventilation'] ?? null,
            'roofing' => $data['roofing'] ?? null,
            'skylights_sf' => $data['skylights_sf'] ?? null,
            'coverage' => $data['coverage'] ?? null,
            'transformer_capacity' => $data['transformer_capacity'] ?? null,
            'expansion_land' => $data['expansion_land'] ?? null,
            'columns_spacing_ft' => $data['columns_spacing_ft'] ?? null,
            'floor_thickness_in' => $data['floor_thickness_in'] ?? null,
            'floor_resistance' => $data['floor_resistance'] ?? null,
            'expansion_up_to_sf' => $data['expansion_up_to_sf'] ?? null,
            'class' => $data['class'] ?? null,
            'generation' => $data['generation'] ?? null,
            'currency' => $data['currency'] ?? null,
            'tenancy' => $data['tenancy'] ?? null,
            'construction_type' => $data['construction_type'] ?? null,
            'lightning' => $data['lightning'] ?? null,
            'loading_door' => $data['loading_door'] ?? null,
            'building_type' => $data['building_type'] ?? null,
            'certifications' => $data['certifications'] ?? null,
            'owner_type' => $data['owner_type'] ?? null,
            'stage' => $data['stage'] ?? null,
            'created_at' => $data['created_at'] ?? null,
            'updated_at' => $data['updated_at'] ?? null,
            'deleted_at' => $data['deleted_at'] ?? null,
        ];


        $normalizeNulls($buildingData);

        $building = Building::updateOrCreate(
            ['id' => $data['id']],
            $buildingData
        );

        if ($building->wasRecentlyCreated) {
            $importedBuildings++;
        } else {
            $updatedBuildings++;
        }

        $availabilityData = [];
        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'ba_')) {
                $availabilityKey = substr($key, 3);
                $availabilityData[$availabilityKey] = $value;
            }
        }

        $availabilityData['building_id'] = $building->id;

        $normalizeNulls($availabilityData);

        $availability = BuildingAvailable::updateOrCreate(
            [
                'building_id' => $building->id,
                'avl_date' => $availabilityData['avl_date'] ?? null,
            ],
            $availabilityData
        );

        if ($availability->wasRecentlyCreated) {
            $importedAvailability++;
        } else {
            $updatedAvailability++;
        }
    }

    return $this->success("Imported", data: [
        'message' => 'Import completed',
        'imported_buildings' => $importedBuildings,
        'updated_buildings' => $updatedBuildings,
        'imported_availability' => $importedAvailability,
        'updated_availability' => $updatedAvailability,
    ]);
}





}
