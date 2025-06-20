<?php

namespace App\Http\Controllers;

use App\Enums\BuildingState;
use App\Enums\BuildingStatus;
use App\Http\Requests\ConvertToAvailableRequest;
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
 * @return ApiResponse
 */

public function importAbsorption(ImportBuildingAbsorptionRequest $request): ApiResponse
{
    $request->validated();

    $path = $request->file('file')->getRealPath();
    $csv = array_map('str_getcsv', file($path));
    $header = array_map('trim', array_shift($csv));

    $importedBuildings = 0;
    $updatedBuildings = 0;
    $importedAbsorption = 0;
    $updatedAbsorption = 0;
    $errors = [];

    $normalizeNulls = function (&$data) use (&$normalizeNulls) {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $normalizeNulls($value);
            } else {
                if (is_string($value) && strtoupper($value) === 'NULL') {
                    $value = null;
                }
            }
        }
    };

    $getIdByName = function ($model, $column, $value, $label, $rowIndex) use (&$errors) {
        if (!$value) return null;
        $record = $model::where($column, $value)->first();
        if (!$record) {
            $errors[] = "Row " . ($rowIndex + 2) . ": $label \"$value\" not found.";
            return null;
        }
        return $record->id;
    };

    foreach ($csv as $index => $row) {
        try {
            $data = array_combine($header, $row);
            $normalizeNulls($data);

            if (empty($data['building_name']) || empty($data['ba_avl_date'])) {
                $errors[] = "Row " . ($index + 2) . ": Missing 'building_name' or 'ba_avl_date'";
                continue;
            }

            // BUILDING DATA
            $buildingData = [
                'region_id' => Region::where('name', $data['region'] ?? '')->value('id'),
                'market_id' => Market::where('name', $data['market'] ?? '')->value('id'),
                'sub_market_id' => SubMarket::where('name', $data['sub_market'] ?? '')->value('id'),
                'builder_id' => Developer::where('name', $data['builder'] ?? '')->value('id'),
                'industrial_park_id' => IndustrialPark::where('name', $data['industrial_park'] ?? '')->value('id'),
                'developer_id' => Developer::where('name', $data['developer'] ?? '')->value('id'),
                'owner_id' => Developer::where('name', $data['owner'] ?? '')->value('id'),
                'building_name' => $data['building_name'],
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
            ];

            $normalizeNulls($buildingData);

            $building = Building::where('building_name', $buildingData['building_name'])
                ->where('region_id', $buildingData['region_id'])
                ->where('market_id', $buildingData['market_id'])
                ->where('sub_market_id', $buildingData['sub_market_id'])
                ->where('developer_id', $buildingData['developer_id'])
                ->first();

            if ($building) {
                $building->fill($buildingData)->save();
                $updatedBuildings++;
            } else {
                $building = Building::create($buildingData);
                $importedBuildings++;
            }

            // AVAILABILITY DATA
            $absorptionData = [];
            foreach ($data as $key => $value) {
                if (str_starts_with($key, 'ba_')) {
                    $field = substr($key, 3);
                    $absorptionData[$field] = $value;
                }
            }

            $absorptionData['building_id'] = $building->id;

            $absorptionData['abs_tenant_id'] = $getIdByName(Tenant::class, 'name', $data['ba_avl_tenant_name'] ?? null, 'Tenant', $index);
            $absorptionData['abs_industry_id'] = $getIdByName(Industry::class, 'name', $data['ba_avl_industry_name'] ?? null, 'Industry', $index);
            $absorptionData['abs_country_id'] = $getIdByName(Country::class, 'name', $data['ba_avl_country_name'] ?? null, 'Country', $index);
            $absorptionData['broker_id'] = $getIdByName(Broker::class, 'name', $data['ba_avl_broker_name'] ?? null, 'Broker', $index);
            $absorptionData['abs_shelter_id'] = $getIdByName(Shelter::class, 'name', $data['ba_avl_shelter_name'] ?? null, 'Shelter', $index);

            $normalizeNulls($absorptionData);

            if (!empty($absorptionData['size_sf']) && !empty($building->building_size_sf)) {
                if ((float)$absorptionData['size_sf'] > (float)$building->building_size_sf) {
                    $absorptionData['size_sf'] = $building->building_size_sf;
                }
            }

            $existingAbsorption = BuildingAvailable::where('building_id', $building->id)
                ->where('building_state', BuildingState::ABSORPTION->value)
                ->first();

            if ($existingAbsorption) {
                $existingAbsorption->fill($absorptionData)->save();
                $updatedAbsorption++;
            } else {
                BuildingAvailable::create($absorptionData);
                $importedAbsorption++;
            }

        } catch (\Throwable $e) {
            $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
        }
    }

    return $this->success("Import completed", data: [
        'imported_buildings' => $importedBuildings,
        'updated_buildings' => $updatedBuildings,
        'imported_absorption' => $importedAbsorption,
        'updated_absorption' => $updatedAbsorption,
        'errors' => $errors,
    ]);
}



}
