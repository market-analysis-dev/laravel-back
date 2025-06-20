<?php

namespace App\Http\Controllers;

use App\Enums\BuildingBuildingType;
use App\Enums\BuildingCertifications;
use App\Enums\BuildingClass;
use App\Enums\BuildingCompanyType;
use App\Enums\BuildingDeal;
use App\Enums\BuildingFinalUse;
use App\Enums\BuildingFireProtectionSystem;
use App\Enums\BuildingGeneration;
use App\Enums\BuildingLightning;
use App\Enums\BuildingLoadingDoor;
use App\Enums\BuildingOwnerType;
use App\Enums\BuildingStage;
use App\Enums\BuildingStatus;
use App\Enums\BuildingTenancy;
use App\Enums\BuildingType;
use App\Enums\BuildingTypeConstruction;
use App\Enums\TechnicalImprovements;
use App\Http\Requests\IndexBuildingRequest;
use App\Http\Requests\IndexLocationRequest;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingDraftRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Models\Building;
use App\Models\Developer;
use App\Models\IndustrialPark;
use App\Models\Market;
use App\Models\Region;
use App\Models\SubMarket;
use App\Responses\ApiResponse;
use App\Services\BuildingService;
use App\Services\FileService;
use App\Services\ImageOptimizationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use PDF;

class BuildingController extends ApiController implements HasMiddleware
{
    private BuildingService $buildingService;
    private FileService $fileService;

    public static function middleware()
    {
        return [
            new Middleware('permission:buildings.index', only: ['index']),
            new Middleware('permission:buildings.show', only: ['show']),
            new Middleware('permission:buildings.create', only: ['store']),
            new Middleware('permission:buildings.update', only: ['update']),
            new Middleware('permission:buildings.approve', only: ['approve']),
            new Middleware('permission:buildings.draft', only: ['draft']),
            new Middleware('permission:buildings.uploadFiles', only: ['uploadFiles']),
            new Middleware('permission:buildings.layoutDesign', only: ['layoutDesign']),
        ];
    }

    public function __construct(BuildingService $buildingService, FileService $fileService)
    {
        $this->buildingService = $buildingService;
        $this->fileService = $fileService;
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

        if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
            $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
        }

        $building = $this->buildingService->create($validated)->refresh();

        if ($request->hasFile('files')) {
            $type = $request->input('type');
            $uploadedFilesInfo = $this->fileService->uploadBuildingFiles($request->file('files'), $building->id, $type);
        }

        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
        }
        return $this->success('Building created successfully', [
            'building' => $building,
            'uploaded_files' => $uploadedFilesInfo ?? null,
        ]);
    }

    public function show(Building $building): ApiResponse
    {
        $building = $this->buildingService->show($building);

        if (!empty($building->above_market_tis)) {
            $building->above_market_tis = explode(',', $building->above_market_tis);
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
            $validated = $request->validated();

            if ($validated['sqftToM2'] ?? false) {
                $validated = $this->buildingService->convertMetrics($validated);
            }

            if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
                $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
            }

            $building = $this->buildingService->update($building, $validated);

            if ($request->hasFile('files')) {
                $type = $request->input('type');

                $deletedFiles = $this->fileService->deleteBuildingFilesByType($request->file('files'), $building->id);

                $uploadedFilesInfo = $this->fileService->uploadBuildingFiles($request->file('files'), $building->id, $type);
            }


            if (!empty($building->above_market_tis)) {
                $building->above_market_tis = explode(',', $building->above_market_tis);
            }
            return $this->success('Building updated successfully', [
                'building' => $building,
                'uploaded_files' => $uploadedFilesInfo ?? null,
                'deleted_files' => $deletedFiles ?? null,
            ]);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
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
            // return $this->error('Building delete failed', ['error_code' => 422]);
            return $this->error('Building delete failed', status: 422);
        } catch (\Exception $e) {
            // return $this->error($e->getMessage(), ['error_code' => 500]);
            return $this->error($e->getMessage(), status: 500);
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
        $phases = BuildingType::array();

        $filteredPhases = collect($phases)
            ->when(request()->boolean('availability'), function ($collection) {
                return $collection->filter(fn($phase) => in_array($phase, [
                    BuildingType::CONSTRUCTION->value,
                    BuildingType::PLANNED->value,
                    BuildingType::SUBLEASE->value,
                    BuildingType::EXPIRATION->value,
                    BuildingType::INVENTORY->value,
                ]));
            })
            ->when(request()->boolean('absorption'), function ($collection) {
                return $collection->filter(fn($phase) => in_array($phase, [
                    BuildingType::BTS->value,
                    BuildingType::EXPANSION->value,
                    BuildingType::INVENTORY->value,
                    BuildingType::BTS_EXPANSION->value,
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
        return $this->success(data: BuildingGeneration::array());
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

    /**
     * @return ApiResponse
     */
    public function listBuildingsCompanyTypes(): ApiResponse
    {
        return $this->success(data: BuildingCompanyType::array());
    }

    /**
     * @return ApiResponse
     */
    public function listFinalUses(): ApiResponse
    {
        return $this->success(data: BuildingFinalUse::array());
    }

    public function listBuildingTypes(): ApiResponse
    {
        return $this->success(data: BuildingBuildingType::array());
    }

    public function listBuildingCertifications(): ApiResponse
    {
        return $this->success(data: BuildingCertifications::array());
    }

    public function listBuildingOwnerTypes(): ApiResponse
    {
        return $this->success(data: BuildingOwnerType::array());
    }

    public function listBuildingStages(): ApiResponse
    {
        return $this->success(data: BuildingStage::array());
    }

    public function layoutDesign($buildingId)
    {
        return response()->make(
            $this->buildingService->layoutDesign($buildingId),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

    /**
     * @param Building $building
     * @return ApiResponse
     */
    public function draft(Building $building): ApiResponse
    {
        $result = $this->buildingService->createDraft($building);

        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }

        return $this->success($result['success'], data: $result['data']);
    }

    /**
     * @param Building $building
     * @return ApiResponse
     */
    public function getDraft(Building $building): ApiResponse
    {
        $draft = $this->buildingService->getDraft($building);

        if (!$draft) {
            return $this->error(message: 'Draft not found.', status: 404);
        }

        return $this->success(data: $draft);
    }

    /**
     * @param UpdateBuildingDraftRequest $request
     * @param Building $building
     * @return ApiResponse
     */
    public function updateDraft(UpdateBuildingDraftRequest $request, Building $building): ApiResponse
    {

        $validated = $request->validated();
        $result = $this->buildingService->updateDraft($building, $validated);

        if (!$result) {
            return $this->error('Draft not found.', status: 404);
        }

        $message = ($result->status === BuildingStatus::DRAFT->value)
            ? 'Draft updated successfully.'
            : 'Draft deleted and applied to the original building.';

        return $this->success(message: $message, data: $result);
    }

    /**
     * @param Building $building
     * @return ApiResponse
     */
    public function deleteDraft(Building $building): ApiResponse
    {
        $result = $this->buildingService->deleteDraft($building);
        if (isset($result['error'])) {
            return $this->error($result['error'], status: $result['status']);
        }
        return $this->success($result['success'], data: $result['data']);
    }

    public function listRegions(IndexLocationRequest $request): ApiResponse
    {
        $regions = Region::query();

        $this->filterLocations($regions, $request);
        $regions = $regions->select('id', 'name')->orderBy('name')->get();

        return $this->success(data: $regions);
    }

    public function listMarkets(IndexLocationRequest $request): ApiResponse
    {
        $query = Market::query();

        $this->filterLocations($query, $request);
        $markets = $query->select('id', 'name', 'region_id')->orderBy('name')->get();

        return $this->success(data: $markets);
    }

    public function listSubMarkets(IndexLocationRequest $request): ApiResponse
    {
        $query = SubMarket::query();

        $this->filterLocations($query, $request);
        $subMarkets = $query->select('id', 'name', 'market_id')->orderBy('name')->get();

        return $this->success(data: $subMarkets);
    }

    public function listDevelopers(IndexLocationRequest $request): ApiResponse
    {
        $query = Developer::select('id', 'name')
            ->where('is_developer', true);

        $this->filterLocations($query, $request);

        $developers = $query->select('id', 'name')->orderBy('name')->get();
        return $this->success(data: $developers);
    }

    public function listIndustrialParks(IndexLocationRequest $request): ApiResponse
    {
        $query = IndustrialPark::query();

        $this->filterLocations($query, $request);
        $industrialParks = $query->select('id', 'name', 'region_id', 'market_id', 'sub_market_id')->orderBy('name')->get();

        return $this->success(data: $industrialParks);
    }


    /**
     * @param \Illuminate\Database\Eloquent\Builder|\App\Models\Region|\App\Models\Market|\App\Models\SubMarket|\App\Models\IndustrialPark $query
     * @param \App\Http\Requests\IndexLocationRequest $request
     * @return void
     */
    private function filterLocations(Builder|Region|Market|SubMarket|IndustrialPark $query, IndexLocationRequest $request): void
    {
        $hasAnyParam = collect($request->query())->only([
            'region_id',
            'market_id',
            'sub_market_id',
            'developer_id',
            'industrial_park_id',
            'building_id',
        ])->filter()->isNotEmpty();

        if ($hasAnyParam) {
            $query->whereHas('buildings', function (Builder $query) use ($request) {
                if ($request->query('region_id')) {
                    $query->where('region_id', $request->query('region_id'));
                }
                if ($request->query('market_id')) {
                    $query->where('market_id', $request->query('market_id'));
                }
                if ($request->query('sub_market_id')) {
                    $query->where('sub_market_id', $request->query('sub_market_id'));
                }
                if ($request->query('developer_id')) {
                    $query->where('developer_id', $request->query('developer_id'));
                }
                if ($request->query('industrial_park_id')) {
                    $query->where('industrial_park_id', $request->query('industrial_park_id'));
                }
                if ($request->query('building_id')) {
                    $query->where('id', $request->query('building_id'));
                }
            });
        } else {
            $query->has('buildings');
        }
    }

}
