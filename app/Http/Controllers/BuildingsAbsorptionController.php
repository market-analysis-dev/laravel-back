<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertToAvailableRequest;
use App\Http\Requests\StoreBuildingsAbsorptionRequest;
use App\Http\Requests\UpdateBuildingsAbsorptionRequest;
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Services\BuildingsAvailableService;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Enums\BuildingState;

class BuildingsAbsorptionController extends ApiController
{
    private BuildingsAvailableService $buildingAvailableService;

    public function __construct(BuildingsAvailableService $buildingAvailableService)
    {
        $this->buildingAvailableService = $buildingAvailableService;
    }

    /**
     * @param Request $request
     * @param Building $building
     * @return ApiResponse
     */
    public function index(Request $request, Building $building): ApiResponse
    {
        $validated = $request->validate([
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable',

            'tenantName' => 'nullable',
            'industryName' => 'nullable',
            'abs_lease_term_month' => 'nullable',
            'abs_closing_date' => 'nullable',
            'abs_final_use' => 'nullable',
            'abs_sale_price' => 'nullable',

            'column' => 'nullable|in:tenantName,industryName,abs_lease_term_month,abs_closing_date,abs_final_use,abs_sale_price',
            'state' => 'nullable|in:asc,desc',
        ]);

        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        $absorptions = BuildingAvailable::with(['tenant', 'industry'])->where('building_id', $building->id)
        ->where('building_state', '=', BuildingState::ABSORPTION->value)
        ->when($validated['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('abs_lease_term_month', 'like', "%{$search}%")
                    ->orWhere('abs_closing_date', 'like', "%{$search}%")
                    ->orWhere('abs_sale_price', 'like', "%{$search}%")
                    ->orWhere('abs_final_use', 'like', "%{$search}%");
            });
        })
        ->when($validated['abs_lease_term_month'] ?? false, function ($query, $abs_lease_term_month) {
            $query->where('abs_lease_term_month', 'like', "%{$abs_lease_term_month}%");
        })
        ->when($validated['abs_closing_date'] ?? false, function ($query, $abs_closing_date) {
            $query->where('abs_closing_date', 'like', "%{$abs_closing_date}%");
        })
        ->when($validated['abs_final_use'] ?? false, function ($query, $abs_final_use) {
            $query->where('abs_final_use', 'like', "%{$abs_final_use}%");
        })
        ->when($validated['abs_sale_price'] ?? false, function ($query, $abs_sale_price) {
            $query->where('abs_sale_price', 'like', "%{$abs_sale_price}%");
        })
        ->when($validated['tenantName'] ?? false, function ($query, $tenantName) {
            $query->whereHas('tenant', function ($query) use ($tenantName) {
                $query->where('name', 'like', "%{$tenantName}%");
            });
        })
        ->when($validated['industryName'] ?? false, function ($query, $industryName) {
            $query->whereHas('industry', function ($query) use ($industryName) {
                $query->where('name', 'like', "%{$industryName}%");
            });
        })
        ->orderBy($order, $direction)
        ->paginate($size);

        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

        return $this->success(data: $absorptions);
    }


    /**
     * @param StoreBuildingsAbsorptionRequest $request
     * @param Building $building
     * @return ApiResponse
     */
    public function store(StoreBuildingsAbsorptionRequest $request, Building $building): ApiResponse
    {
        $validated = $request->validated();
        $validated['building_id'] = $building->id;
        $validated['building_state'] = BuildingState::ABSORPTION;

        if ($validated['sqftToM2'] ?? false) {
            $validated = $this->buildingAvailableService->convertMetrics($validated);
        }

        if (!empty($validated['fire_protection_system']) && is_array($validated['fire_protection_system'])) {
            $validated['fire_protection_system'] = implode(',', $validated['fire_protection_system']);
        }
        if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
            $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
        }

        $absorption = $this->buildingAvailableService->create($validated);

        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }

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

        if ($buildingAbsorption->building_state !== BuildingState::ABSORPTION->value) {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        if (!empty($building->fire_protection_system)) {
            $building->fire_protection_system = explode(',', $building->fire_protection_system);
        }
        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
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
        if ($buildingAbsorption->building_state !== BuildingState::ABSORPTION->value) {
            return $this->error('Invalid building state', ['error_code' => 403]);
        }

        $validated = $request->validated();
        $validated['building_id'] = $building->id;
        $validated['building_state'] = BuildingState::ABSORPTION;
        try {
            if ($validated['sqftToM2'] ?? false) {
                $validated = $this->buildingAvailableService->convertMetrics($validated);
            }
            if (!empty($validated['fire_protection_system']) && is_array($validated['fire_protection_system'])) {
                $validated['fire_protection_system'] = implode(',', $validated['fire_protection_system']);
            }
            if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
                $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
            }
            $building = $this->buildingAvailableService->update($buildingAbsorption, $validated);

            if (!empty($building->fire_protection_system)) {
                $building->fire_protection_system = explode(',', $building->fire_protection_system);
            }
            if (!empty($building->above_market_tis)) {
                $building->above_market_tis = explode(',', $building->above_market_tis);
            }

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

        if ($buildingAbsorption->building_state !== BuildingState::ABSORPTION->value) {
            return $this->error('Invalid building state', ['error_code' => 403]);
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




}
