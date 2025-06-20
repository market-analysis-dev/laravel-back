<?php

namespace App\Services;

use App\Models\BuildingAvailable;
use App\Models\BuildingLog;
use App\Services\BuildingsAvailableService;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Enums\BuildingStatus;
use App\Enums\BuildingState;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BuildingService
{
    private BuildingsAvailableService $buildingsAvailableService;
    private FileService $fileService;

    public function __construct(
        BuildingsAvailableService $buildingsAvailableService,
        FileService $fileService
    )
    {
        $this->buildingsAvailableService = $buildingsAvailableService;
        $this->fileService = $fileService;
    }

    /**
     * @param array $buildingData
     * @param array $availabilityData
     * @return \Illuminate\Database\TReturn|mixed
     * @throws \Throwable
     */
    public function createWithAvailability(
        array $buildingData,
        array $availabilityData,
        ?array $files = null,
        ?string $fileType = null
    ): mixed
    {
        /* Building */
        if ($buildingData['sqftToM2']) {
            $buildingData = $this->convertMetrics($buildingData);
        }

        if (isset($availabilityData['is_starting_construction']) && (int) $availabilityData['is_starting_construction'] === 1) {
            $now = now();
            $buildingData['year_built'] = $now->year;
            $buildingData['construction_date'] = $now->toDateString();
        }

        /* Building Availability */
        if (!empty($availabilityData['sqftToM2']) || !empty($availabilityData['yrToMo'])) {
            $availabilityData = $this->buildingsAvailableService->convertMetrics($availabilityData);
        }
        if (!empty($availabilityData['fire_protection_system']) && is_array($availabilityData['fire_protection_system'])) {
            $availabilityData['fire_protection_system'] = implode(',', $availabilityData['fire_protection_system']);
        }

        return DB::transaction(function () use ($buildingData, $availabilityData, $files, $fileType) {

            if (isset($buildingData['id'])) {
                $building = Building::findOrFail($buildingData['id']);
                $building = $this->update($building, $buildingData);
            } else {
                $building = $this->create($buildingData);
            }
            $availabilityData['building_id'] = $building->id;
            $absorptionData['building_state'] = BuildingState::AVAILABILITY->value;
            $availabilityBuilding = $this->buildingsAvailableService->create($availabilityData);

            $uploadedFilesInfo = null;

        if ($files && is_array($files)) {
            $uploadedFilesInfo = $this->fileService->uploadBuildingFiles($files, $building->id);
        }

            return [
                'building' => $building,
                'availability' => $availabilityBuilding,
                'uploaded_files' => $uploadedFilesInfo,
            ];
        });
    }



    public function createWithAbsorption(
        array $buildingData,
        array $absorptionData,
        ?array $files = null,
        ?string $fileType = null
    ): mixed
    {
        if (isset($absorptionData['is_starting_construction']) && (int) $absorptionData['is_starting_construction'] === 1) {
            $now = now();
            $buildingData['year_built'] = $now->year;
            $buildingData['construction_date'] = $now->toDateString();
        }

        /* Building */
        if ($buildingData['sqftToM2'] ?? false) {
            $buildingData = $this->convertMetrics($buildingData);
        }

        /* Building Absorption */
        if (!empty($absorptionData['sqftToM2']) || !empty($absorptionData['yrToMo'])) {
            $absorptionData = $this->buildingsAvailableService->convertMetrics($absorptionData);
        }
        if (!empty($absorptionData['fire_protection_system']) && is_array($absorptionData['fire_protection_system'])) {
            $absorptionData['fire_protection_system'] = implode(',', $absorptionData['fire_protection_system']);
        }

        return DB::transaction(function () use ($buildingData, $absorptionData, $files, $fileType) {
            if (!empty($buildingData['id'])) {
                $building = Building::findOrFail($buildingData['id']);
                $building = $this->update($building, $buildingData);
            } else {
                $building = $this->create($buildingData);
            }

            $absorptionData['building_id'] = $building->id;
            $absorptionData['building_state'] = BuildingState::ABSORPTION->value;
        $absorptionBuilding = $this->buildingsAvailableService->create($absorptionData);

        $uploadedFilesInfo = null;

        if ($files && is_array($files)) {
            $uploadedFilesInfo = $this->fileService->uploadBuildingFiles($files, $building->id);
        }

        return [
            'building' => $building,
            'absorption' => $absorptionBuilding,
            'uploaded_files' => $uploadedFilesInfo,
        ];
    });
    }



    /**
     * @param array $buildingData
     * @param array $availabilityData
     * @return mixed
     * @throws \Throwable
     */
    public function updateWithAvailability(
        array $buildingData,
        array $availabilityData,
        ?array $files = null,
        ?string $fileType = null
    ): mixed
    {

        if (!empty($buildingData['sqftToM2'])) {
            $buildingData = $this->convertMetrics($buildingData);
        }

        if (!empty($availabilityData['sqftToM2']) || !empty($availabilityData['yrToMo'])) {
            $availabilityData = $this->buildingsAvailableService->convertMetrics($availabilityData);
        }

        if (!empty($availabilityData['fire_protection_system']) && is_array($availabilityData['fire_protection_system'])) {
            $availabilityData['fire_protection_system'] = implode(',', $availabilityData['fire_protection_system']);
        }

        return DB::transaction(function () use ($buildingData, $availabilityData, $files, $fileType) {
            if (empty($buildingData['id'])) {
                throw new \InvalidArgumentException('Missing building ID for update.');
            }

            $building = Building::findOrFail($buildingData['id']);
            $building = $this->update($building, $buildingData);

            if (empty($availabilityData['id'])) {
                throw new \InvalidArgumentException('Missing availability ID for update.');
            }

            $availability = BuildingAvailable::findOrFail($availabilityData['id']);

            if ($availability->building_state !== BuildingState::AVAILABILITY->value) {
                throw ValidationException::withMessages([
                    'availability.id' => __('The availability must be in AVAILABILITY state to update.'),
                ]);
            }

            $availabilityData['building_id'] = $building->id;
            $availability = $this->buildingsAvailableService->update($availability, $availabilityData);

            $uploadedFilesInfo = null;

        if ($files && is_array($files)) {
            $uploadedFilesInfo = $this->fileService->uploadBuildingFiles($files, $building->id);
        }

            return [
                'building' => $building,
                'availability' => $availability,
                'uploaded_files' => $uploadedFilesInfo,
            ];
        });
    }


    public function updateWithAbsorption(
        array $buildingData,
        array $absorptionData,
        ?array $files = null,
        ?string $fileType = null
    ): mixed {
        if (!empty($buildingData['sqftToM2'])) {
            $buildingData = $this->convertMetrics($buildingData);
        }

        if (!empty($absorptionData['sqftToM2']) || !empty($absorptionData['yrToMo'])) {
            $absorptionData = $this->buildingsAvailableService->convertMetrics($absorptionData);
        }

        if (!empty($absorptionData['fire_protection_system']) && is_array($absorptionData['fire_protection_system'])) {
            $absorptionData['fire_protection_system'] = implode(',', $absorptionData['fire_protection_system']);
        }

        return DB::transaction(function () use ($buildingData, $absorptionData, $files, $fileType) {
            if (empty($buildingData['id'])) {
                throw new \InvalidArgumentException('Missing building ID for update.');
            }

            $building = Building::findOrFail($buildingData['id']);
            $building = $this->update($building, $buildingData);

            if (empty($absorptionData['id'])) {
                throw new \InvalidArgumentException('Missing absorption ID for update.');
            }

            $absorption = BuildingAvailable::findOrFail($absorptionData['id']);

            if ($absorption->building_state !== BuildingState::ABSORPTION->value) {
                throw ValidationException::withMessages([
                    'absorption.id' => __('The availability must be in ABSORPTION state to update.'),
                ]);
            }

        $absorptionData['building_id'] = $building->id;

        $absorption = $this->buildingsAvailableService->update($absorption, $absorptionData);

        $uploadedFilesInfo = null;

        if ($files && is_array($files)) {
            $uploadedFilesInfo = $this->fileService->uploadBuildingFiles($files, $building->id);
        }

        return [
            'building' => $building,
            'absorption' => $absorption,
            'uploaded_files' => $uploadedFilesInfo,
        ];
    });
    }




    /**
     * @param array $validated
     * @return mixed
     */
    public function filter(array $validated): mixed
    {
        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        return Building::with(['market', 'subMarket', 'industrialPark','developer'])
            ->leftJoin('cat_markets', 'cat_markets.id', '=', 'buildings.market_id')
            ->leftJoin('cat_sub_markets', 'cat_sub_markets.id', '=', 'buildings.sub_market_id')
            ->leftJoin('industrial_parks', 'industrial_parks.id', '=', 'buildings.industrial_park_id')
            ->select('buildings.*', 'cat_markets.name AS marketName', 'cat_sub_markets.name AS submarketName', 'industrial_parks.name AS industrialParkName')
            ->when($validated['search'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search){
                    $query->where('buildings.status', 'like', "%{$search}%")
                        ->orWhere('buildings.building_name', 'like', "%{$search}%");
                });
            })
            ->when($validated['status'] ?? false, function ($query, $status) {
                $query->where('buildings.status', $status);
            })
            ->when($validated['building_name'] ??  false, function ($query, $building_name){
                $query->where('buildings.building_name', 'like', "%{$building_name}%");
            })
            ->when($validated['marketName'] ?? false, function ($query, $marketName) {
                $query->whereHas('market', function ($query) use ($marketName) {
                    $query->where('name', 'like', "%{$marketName}%");
                });
            })
            ->when($validated['submarketName'] ?? false, function ($query, $submarketName){
                $query->whereHas('subMarket', function ($query) use ($submarketName) {
                    $query->where('name', 'like', "%{$submarketName}%");
                });
            })
            ->when($validated['industrialParkName'] ?? false, function ($query, $industrialParkName) {
                $query->whereHas('industrialPark', function ($query) use ($industrialParkName) {
                    $query->where('name', 'like', "%{$industrialParkName}%");
                });
            })
            ->when($validated['region_id'] ?? false, function ($query, $regionId) {
                $query->where('buildings.region_id', $regionId);
            })
            ->when($validated['market_id'] ?? false, function ($query, $marketId) {
                $query->where('buildings.market_id', $marketId);
            })
            ->when($validated['sub_market_id'] ?? false, function ($query, $subMarketId) {
                $query->where('buildings.sub_market_id', $subMarketId);
            })
            ->when($validated['developer_id'] ?? false, function ($query, $developerId) {
                $query->where('buildings.developer_id', $developerId);
            })
            ->when($validated['industrial_park_id'] ?? false, function ($query, $industrialParkId) {
                $query->where('buildings.industrial_park_id', $industrialParkId);
            })
            ->orderBy($order, $direction)
            ->paginate($size);
    }

    public function show(Building $building): Building
    {
        return $building->load([
            'region',
            'market',
            'subMarket',
            'builder',
            'industrialPark',
            'developer',
            'owner',
            'buildingsAvailable',
            'files',
        ]);
    }

    public function create(array $validated): Building
    {
        return Building::create($validated);
    }

    public function update(Building $building, array $validated): Building
    {
        /*if($validated['status'] === BuildingStatus::ENABLED->value) {
            $this->makeBuildingLogRecord($building);
        }*/
        $building->update($validated);
        return $building;
    }

    public function convertMetrics(array $data): array
    {
        if (isset($data['building_size_sf'])) {
            $data['building_size_sf'] = $this->convertM2ToSqFt($data['building_size_sf']);
        }

        if (isset($data['total_land_sf'])) {
            $data['total_land_sf'] = $this->convertM2ToSqFt($data['total_land_sf']);
        }

        if (isset($data['clear_height_ft'])) {
            $data['clear_height_ft'] = $this->convertMToFt($data['clear_height_ft']);
        }

        if (isset($data['floor_thickness_in'])) {
            $data['floor_thickness_in'] = $this->convertInToCm($data['floor_thickness_in']);
        }

        if (isset($data['offices_space_sf'])) {
            $data['offices_space_sf'] = $this->convertM2ToSqFt($data['offices_space_sf']);
        }

        if (isset($data['columns_spacing_ft'])) {
            $data['columns_spacing_ft'] = $this->convertColumnsSpacingToFt($data['columns_spacing_ft']);
        }

        return $data;
    }

    public function convertM2ToSqFt(float $m2): int
    {
        return (int) round($m2 * 10.764);
    }

    public function convertMToFt(float $m): int
    {
        return (int) round($m * 3.281);
    }

    public function convertInToCm(float $in): int
    {
        return (int) round($in * 2.54);
    }

    public function convertColumnsSpacingToFt(string $spacing): string
    {
        $parts = explode('x', $spacing);
        $convertedParts = array_map(fn($value) => $this->convertMToFt((float) $value), $parts);
        return implode('x', $convertedParts);
    }

    public function getBuildingData($buildingId)
    {
        return Building::query()
            ->leftJoin('cat_markets as market', 'buildings.market_id', '=', 'market.id')
            ->leftJoin('cat_sub_markets as submarket', 'buildings.sub_market_id', '=', 'submarket.id')
            ->leftJoin('industrial_parks as industrial_parks', 'buildings.industrial_park_id', '=', 'industrial_parks.id')
            ->leftJoin('buildings_available as building_av', 'building_av.building_id', '=', 'buildings.id')
            ->select([
                'buildings.id',
                'buildings.total_land_sf',
                'buildings.building_size_sf',
                'buildings.expansion_up_to_sf',
                'buildings.construction_type',
                'buildings.building_name',
                'buildings.floor_thickness_in',
                'buildings.floor_resistance',
                'buildings.roof_system',
                'buildings.clear_height_ft',
                'building_av.avl_building_dimensions_ft',
                'buildings.columns_spacing_ft',
                'buildings.bay_size',
                'building_av.dock_doors',
                'building_av.knockouts_docks',
                'building_av.truck_court_ft',
                'building_av.trailer_parking_space',
                'building_av.shared_truck',
                'buildings.offices_space_sf',
                'market.name as market_name',
                'submarket.name as submarket_name',
                'industrial_parks.name as industrial_park_name',
                'buildings.year_built',
                'buildings.currency',
            ])
            ->where('buildings.id', $buildingId)
            ->firstOrFail();
    }

    public function userData($userId)
    {
        return User::query()
            ->leftJoin('companies', 'users.company_id', '=', 'companies.id')
            ->leftJoin('files', 'companies.logo_id', '=', 'files.id') // Unir con la tabla files
            ->select([
                'users.id',
                'users.name',
                'users.middle_name',
                'users.last_name',
                'users.email as email',
                'companies.name as company_name',
                'companies.primary_color',
                'companies.secondary_color',
                'files.path as logo_path' // Obtener la ruta del logo
            ])
            ->where('users.id', $userId)
            ->first();
    }

    public function getBuildingImages($buildingId)
    {
        // Obtener los archivos filtrando por los tipos necesarios
        $files = \DB::table('building_files')
            ->join('files', 'building_files.file_id', '=', 'files.id')
            ->where('building_files.building_id', $buildingId)
            ->whereIn('building_files.type', ['Front Page', 'Aerial', 'Gallery'])
            ->select('building_files.type', 'files.path')
            ->get();

        // Validar si los archivos existen en el directorio
        $validFiles = [];

        foreach ($files as $file) {
            $filePath = storage_path('app/public/' . $file->path); // Ruta del archivo en storage
            if (file_exists($filePath)) {
                $validFiles[] = [
                    'type' => $file->type,
                    'url' => asset('storage/' . $file->path) // Convertir a URL accesible
                ];
            }
        }

        return $validFiles;
    }

    public function layoutDesign($buildingId)
    {
        $userId = auth()->id();
        $user = $this->userData($userId);
        $building = $this->getBuildingData($buildingId);
        $images = $this->getBuildingImages($buildingId); // Obtener imágenes validadas

        // Obtener la ruta del logo
        $logoPath = $user->logo_path ? storage_path('app/public/' . $user->logo_path) : null;
        $pdf = Pdf::loadView('buildings.layout-design', compact('building', 'user', 'logoPath', 'images'));
        return $pdf->stream('layout-design.pdf');
    }

    /**
     * @param Building $building
     * @return array
     */
    public function createDraft(Building $building): array
    {
        if ($building->status === BuildingStatus::DRAFT->value) {
        return ['error' => 'Cannot create a draft from another draft.', 'status' => 400];
    }

        $existingDraft = Building::where('building_id', $building->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();

        if ($existingDraft) {
            return ['error' => 'Draft already exists for this building.', 'status' => 400];
        }

        $draft = $building->replicate();
        $draft->status = BuildingStatus::DRAFT->value;
        $draft->building_id = $building->id;
        $draft->save();

        return ['success' => 'Draft created successfully.', 'data' => $draft];
    }

    /**
     * @param Building $building
     * @return Building|null
     */
    public function getDraft(Building $building): ?Building
    {
        return Building::where('building_id', $building->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();
    }

    /**
     * @param Building $building
     * @param array $validated
     * @return Building|null
     */
    public function updateDraft(Building $building, array $validated): ?Building
    {
        $draft = $this->getDraft($building);

        if (!$draft) {
            return null;
        }

        if ($validated['sqftToM2'] ?? false) {
            $validated = $this->convertMetrics($validated);
        }

        if (!empty($validated['fire_protection_system']) && is_array($validated['fire_protection_system'])) {
            $validated['fire_protection_system'] = implode(',', $validated['fire_protection_system']);
        }

        if (!empty($validated['above_market_tis']) && is_array($validated['above_market_tis'])) {
            $validated['above_market_tis'] = implode(',', $validated['above_market_tis']);
        }

        if (isset($validated['status']) && $validated['status'] === BuildingStatus::ENABLED->value) {
        $updateData = Arr::except($validated, ['status']);
        $this->makeBuildingLogRecord($building);
        $building->update($updateData);
        $draft->delete();
        return $building;
    }

        $draft->update($validated);
        return $draft;
    }

    /**
     * @param Building $building
     * @return array
     */
    public function deleteDraft(Building $building): array
    {
        $draft = Building::where('building_id', $building->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();
        if (!$draft) {
            return ['error' => 'Draft not found.', 'status' => 404];
        }
        $draft->delete();
        return ['success' => 'Draft deleted successfully.', 'data' => $draft];
    }

    /**
     * @param Building $building
     */
    private function makeBuildingLogRecord(Building $building):void
    {
        $logRecord = new BuildingLog($building->toArray());
        $logRecord['building_id'] = $building->id;
        $logRecord->save();
    }

}
