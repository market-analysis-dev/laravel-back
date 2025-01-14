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
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Models\Building;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;

class BuildingController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(Request $request): ApiResponse
    {
        $validated = $request->validate([
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable',
            'status' => 'nullable',
            'building_name' => 'nullable',
            'marketName' => 'nullable',
            'submarketName' => 'nullable',
            'industrialParkName' => 'nullable',
            'column' => 'nullable|in:status,building_name,marketName,submarketName,industrialPark',
            'state' => 'nullable|in:asc,desc',
        ]);

        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        $buildings = Building::with([
            'market',
            'subMarket',
            'industrialPark',
        ])
        ->when($validated['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('status', 'like', "%{$search}%")
                    ->orWhere('building_name', 'like', "%{$search}%");
            });
        })
        ->when($validated['status'] ?? false, function ($query, $status) {
            $query->where('status', $status);
        })
        ->when($validated['building_name'] ?? false, function ($query, $building_name) {
            $query->where('building_name', 'like', "%{$building_name}%");
        })
        ->when($validated['marketName'] ?? false, function ($query, $marketName) {
            $query->whereHas('market', function ($query) use ($marketName) {
                $query->where('name', 'like', "%{$marketName}%");
            });
        })
        ->when($validated['submarketName'] ?? false, function ($query, $submarketName) {
            $query->whereHas('subMarket', function ($query) use ($submarketName) {
                $query->where('name', 'like', "%{$submarketName}%");
            });
        })
        ->when($validated['industrialParkName'] ?? false, function ($query, $industrialParkName) {
            $query->whereHas('industrialPark', function ($query) use ($industrialParkName) {
                $query->where('name', 'like', "%{$industrialParkName}%");
            });
        })
        ->orderBy($order, $direction)
        ->paginate($size);
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
        $building->load([
            'region',
            'market',
            'subMarket',
            'builder',
            'industrialPark',
            'developer',
            'owner',
            'userOwner',
            'contact',
            'buildingsAvailable',
        ]);

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
}