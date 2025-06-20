<?php

namespace App\Services;

use App\Enums\BuildingState;
use App\Enums\BuildingStatus;
use App\Enums\BuildingType;
use App\Enums\BuildingTenancy;
use App\Models\Building;
use App\Models\BuildingAvailable;
use App\Models\BuildingAvailableLog;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class BuildingsAvailableService
{
    public function filterAbsorption(array $validatedData): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $page_size = $validatedData['page_size'] ?? 10;
        $page = $validatedData['page'] ?? 1;
        $sort_column = $validatedData['sort_column'] ?? 'id';
        $sort = $validatedData['sort'] ?? 'desc';

        return BuildingAvailable::where('building_state', BuildingState::ABSORPTION->value)
            ->whereHas('building', function ($query) use ($validatedData) {
                $query
                    ->when($validatedData['building_name'] ?? false, fn($q, $val) => $q->where('building_name', 'like', "%{$val}%"))
                    ->when($validatedData['building_class'] ?? false, fn($q, $val) => $q->where('class', 'like', "%{$val}%"))
                    ->when($validatedData['market'] ?? false, fn($q, $val) => $q->whereHas('market', fn($mq) => $mq->where('name', 'like', "%{$val}%")))
                    ->when($validatedData['sub_market'] ?? false, fn($q, $val) => $q->whereHas('subMarket', fn($sq) => $sq->where('name', 'like', "%{$val}%")))
                    ->when($validatedData['industrial_park'] ?? false, fn($q, $val) => $q->whereHas('industrialPark', fn($iq) => $iq->where('name', 'like', "%{$val}%")))
                    ->when($validatedData['developer'] ?? false, fn($q, $val) => $q->whereHas('developer', fn($dq) => $dq->where('name', 'like', "%{$val}%")));
            })
            ->whereHas('broker', function ($query) use ($validatedData) {
                $query->when($validatedData['broker_name'] ?? false, fn($q, $val) => $q->where('name', 'like', "%{$val}%"));
            })
            ->when($validatedData['abs_type'] ?? false, fn($q, $val) => $q->where('abs_type', 'like', "%{$val}%"))
            ->when($validatedData['closing_quarter'] ?? false, fn($q, $val) => $q->whereClosingDateType('quarter', $validatedData['closing_quarter']))
            ->when($validatedData['closing_year'] ?? false, fn($q, $val) => $q->whereClosingDateType('year', $validatedData['closing_year'] ?? null))
            ->orderBy($sort_column, $sort)
            ->with(['building.market', 'building.subMarket', 'building.industrialPark', 'building.developer', 'broker'])
            ->paginate($page_size, page: $page);
    }

    public function filterAvailable(array $validatedData): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $page_size = $validatedData['page_size'] ?? 10;
        $page = $validatedData['page'] ?? 1;
        $sort_column = $validatedData['sort_column'] ?? 'id';
        $sort = $validatedData['sort'] ?? 'desc';

        return BuildingAvailable::query()
            ->where('building_state', BuildingState::AVAILABILITY->value)
            ->whereHas('building', function ($query) use ($validatedData) {
                $query
                    ->when($validatedData['building_name'] ?? false, fn($q, $val) => $q->where('building_name', 'like', "%{$val}%"))
                    ->when($validatedData['building_class'] ?? false, fn($q, $val) => $q->where('class', 'like', "%{$val}%"))
                    ->when($validatedData['market'] ?? false, fn($q, $val) => $q->whereHas('market', fn($mq) => $mq->where('name', 'like', "%{$val}%")))
                    ->when($validatedData['sub_market'] ?? false, fn($q, $val) => $q->whereHas('subMarket', fn($sq) => $sq->where('name', 'like', "%{$val}%")))
                    ->when($validatedData['industrial_park'] ?? false, fn($q, $val) => $q->whereHas('industrialPark', fn($iq) => $iq->where('name', 'like', "%{$val}%")))
                    ->when($validatedData['developer'] ?? false, fn($q, $val) => $q->whereHas('developer', fn($dq) => $dq->where('name', 'like', "%{$val}%")));
            })
            ->when($validatedData['avl_type'] ?? false, fn($q, $val) => $q->where('avl_type', 'like', "%{$val}%"))
            ->orderBy($sort_column, $sort)
            ->with('building.market', 'building.subMarket', 'building.industrialPark', 'building.developer')
            ->paginate($page_size, page: $page);
    }


    /**
     * @param array $validatedData
     * @param int $buildingId
     * @param int $buildingAbsorptionId
     * @return array
     */
    public function convertToAvailable(array $validatedData, int $buildingId, int $buildingAbsorptionId): array
    {
        $buildingAbsorption = BuildingAvailable::where('building_id', $buildingId)
            ->where('id', $buildingAbsorptionId)
            ->firstOrFail();

        if ($buildingAbsorption->building_state !== 'Absorption') {
            return [
                'success' => false,
                'message' => 'Only records with state "Absorption" can be converted to "Availability".',
                'code' => 400
            ];
        }

        $validatedData['building_state'] = 'Availability';

        $buildingAbsorption->update($validatedData);

        return [
            'success' => true,
            'data' => $buildingAbsorption
        ];


    }

    /**
     * @param array $validatedData
     * @param int $buildingId
     * @param int $buildingAvailableId
     * @return array|\Illuminate\Database\Eloquent\TModel
     */
    public function convertToAbsorption(array $validatedData, int $buildingId, int $buildingAvailableId)
    {
        $buildingAvailable = BuildingAvailable::where('building_id', $buildingId)
            ->where('id', $buildingAvailableId)
            ->firstOrFail();

        if ($buildingAvailable->building_state !== 'Availability') {
            return [
                'success' => false,
                'message' => 'Only records with state "Available" can be converted to "Absorption".',
                'code' => 400
            ];
        }

        $isNegativeAbsorption = $this->isNegativeAbsorption($buildingAvailable->avl_type, $validatedData['abs_type']);

        $validatedData['is_negative_absorption'] = $isNegativeAbsorption;
        $validatedData['building_state'] = 'Absorption';

        $buildingAvailable->update($validatedData);

        return [
            'success' => true,
            'data' => $buildingAvailable
        ];
    }

    /**
     * @param array $validated
     * @return BuildingAvailable
     */
    public function create(array $validated): BuildingAvailable
    {
        /*if($validated['building_state'] == BuildingState::ABSORPTION && $validated['abs_type'] == BuildingType::INVENTORY->value) {
            $validated['building_state'] = true;
    }*/
        $isAbsorption = ($validated['building_state'] ?? null) === BuildingState::ABSORPTION->value;
        $hasBuilding = !empty($validated['building_id']);
        $hasSize = !empty($validated['size_sf']);

    // Only if create from existing building
    if ($isAbsorption && $hasBuilding && $hasSize) {
        $building = Building::findOrFail($validated['building_id']);
        if ($building->tenancy === BuildingTenancy::MULTITENANT->value) {
            $availability = $building->buildingsAvailable()
                ->where('building_state', BuildingState::AVAILABILITY->value)
                ->first();

            $availableSize = $availability?->size_sf ?? $building->size_sf;
            $minimumSpace = $availability?->avl_minimum_space_sf ?? null;

            if ($validated['size_sf'] > $availableSize) {
                throw ValidationException::withMessages([
                    'size_sf' => __('Absorption size cannot exceed availability.'),
                ]);
            }

            if (!is_null($minimumSpace) && $validated['size_sf'] < $minimumSpace) {
                throw ValidationException::withMessages([
                    'size_sf' => __('Absorption size cannot be less than the minimum available space.'),
                ]);
            }

            if ($availability) {
                $availability->size_sf -= $validated['size_sf'];
                $availability->save();
            }
        }
    }
    return BuildingAvailable::create($validated);
    }

    /**
     * @param BuildingAvailable $buildingAvailable
     * @param array $validated
     * @return BuildingAvailable
     */
    public function update(BuildingAvailable $buildingAvailable, array $validated): BuildingAvailable
    {
        $incomingSize = $validated['size_sf'] ?? null;

        if (!empty($incomingSize) && $buildingAvailable->size_sf == 0) {
            $validated['avl_date'] = now()->toDateString();
        }

        if (($validated['status'] ?? BuildingStatus::ENABLED->value) === BuildingStatus::ENABLED->value) {
            $this->makeBuildingAvailableLogRecord($buildingAvailable);
        }
        $buildingAvailable->update($validated);
        return $buildingAvailable;
    }

    /**
     * @param array $data
     * @return array
     */
    public function convertMetrics(array $data): array
    {
        $sqftToM2 = $data['sqftToM2'] ?? false;
        $yrToMo = $data['yrToMo'] ?? false;


        if ($sqftToM2) {
            if (isset($data['size_sf'])) {
                $data['size_sf'] = $this->convertM2ToSqFt($data['size_sf']);
            }

            if (isset($data['truck_court_ft'])) {
                $data['truck_court_ft'] = $this->convertMToFt($data['truck_court_ft']);
            }

            if (isset($data['avl_minimum_space_sf'])) {
                $data['avl_minimum_space_sf'] = $this->convertM2ToSqFt($data['avl_minimum_space_sf']);
            }

            if (isset($data['avl_building_dimensions_ft'])) {
                $data['avl_building_dimensions_ft'] = $this->convertColumnsSpacingToFt($data['avl_building_dimensions_ft']);
            }
        }

        if (isset($data['avl_min_lease'])) {
            $data['avl_min_lease'] = $this->convertUsdM2ToUsdSqft($data['avl_min_lease'], $sqftToM2, $yrToMo);
        }

        if (isset($data['avl_max_lease'])) {
            $data['avl_max_lease'] = $this->convertUsdM2ToUsdSqft($data['avl_max_lease'], $sqftToM2, $yrToMo);
        }

        if (isset($data['abs_sale_price'])) {
            $data['abs_sale_price'] = $this->convertUsdM2ToUsdSqft($data['abs_sale_price'], $sqftToM2, $yrToMo);
        }

        if (isset($data['abs_closing_rate'])) {
            $data['abs_closing_rate'] = $this->convertUsdM2ToUsdSqft($data['abs_closing_rate'], $sqftToM2, $yrToMo);
        }

        if (isset($data['abs_max_lease'])) {
            $data['abs_max_lease'] = $this->convertUsdM2ToUsdSqft($data['abs_max_lease'], $sqftToM2, $yrToMo);
        }

        if (isset($data['abs_min_lease'])) {
            $data['abs_min_lease'] = $this->convertUsdM2ToUsdSqft($data['abs_min_lease'], $sqftToM2, $yrToMo);
        }

        return $data;
    }

    /**
     * @param float $m2
     * @return int
     */
    public function convertM2ToSqFt(float $m2): int
    {
        return (int)round($m2 * 10.764);
    }

    /**
     * @param float $m
     * @return int
     */
    public function convertMToFt(float $m): int
    {
        return (int)round($m * 3.281);
    }

    /**
     * @param float $usdM2
     * @return int
     */
    public function convertUsdM2ToUsdSqft(float $usdM2, bool $sqftToM2 = false, bool $yrToMo = false): int
    {
        if ($sqftToM2 && $yrToMo) {
            return (int)round($usdM2 / (10.764 * 12));
        } elseif ($yrToMo) {
            return (int)round($usdM2 / 12);
        }
        return (int)round($usdM2 / 10.764);
    }

    /**
     * @param string $spacing
     * @return string
     */
    public function convertColumnsSpacingToFt(string $spacing): string
    {
        $parts = explode('x', $spacing);
        $convertedParts = array_map(fn($value) => $this->convertMToFt((float)$value), $parts);
        return implode('x', $convertedParts);
    }

    /**
     * @param string $avlBuildingPhase
     * @param string $absBuildingPhase
     * @return bool
     */
    public function isNegativeAbsorption(string $avlBuildingPhase, string $absBuildingPhase): bool
    {
        if (in_array($avlBuildingPhase, [
                BuildingType::CONSTRUCTION->value,
                BuildingType::EXPIRATION->value
            ]) && $absBuildingPhase == BuildingType::INVENTORY->value) {
            return true;
        }
        return false;
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @param string $state
     * @return array
     */
    public function createDraft(Building $building, BuildingAvailable $buildingAvailable, string $state): array
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return ['error' => 'Building Available not found for this Building', 'status' => 404];
        }
        if ($buildingAvailable->building_state !== $state) {
            return ['error' => 'Invalid building state', 'status' => 403];
        }
        if ($buildingAvailable->status === BuildingStatus::DRAFT->value) {
            return ['error' => 'Cannot create a draft from another draft.', 'status' => 400];
        }
        $existingDraft = BuildingAvailable::where('building_available_id', $buildingAvailable->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();

        if ($existingDraft) {
            return ['error' => 'Draft already exists for this building.', 'status' => 400];
        }
        $draft = $buildingAvailable->replicate();
        $draft->status = BuildingStatus::DRAFT->value;
        $draft->building_available_id = $buildingAvailable->id;
        $draft->save();

        return ['success' => 'Draft created successfully.', 'data' => $draft];
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @param string $state
     * @return array
     */
    public function getDraft(Building $building, BuildingAvailable $buildingAvailable, string $state): array
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return ['error' => 'Building Available not found for this Building', 'status' => 404];
        }

        if ($buildingAvailable->building_state !== $state) {
            return ['error' => 'Invalid building state', 'status' => 403];
        }

        $draft = BuildingAvailable::where('building_available_id', $buildingAvailable->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();
        if (!$draft) {
            return ['error' => 'Draft not found', 'status' => 404];
        }
        if (!empty($draft->fire_protection_system)) {
            $draft->fire_protection_system = explode(',', $draft->fire_protection_system);
        }
        if (!empty($draft->above_market_tis)) {
            $draft->above_market_tis = explode(',', $draft->above_market_tis);
        }
        return ['success' => 'success', 'data' => $draft];
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @param array $validated
     * @param string $state
     * @return array
     */
    public function updateDraft(Building $building, BuildingAvailable $buildingAvailable, array $validated, string $state): array
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return ['error' => 'Building Available not found for this Building', 'status' => 404];
        }

        $draft = BuildingAvailable::where('building_available_id', $buildingAvailable->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();

        if (!$draft) {
            return ['error' => 'Draft not found', 'status' => 404];
        }

        $validated['building_id'] = $building->id;
        $validated['building_available_id'] = $buildingAvailable->id;
        $validated['building_state'] = $state;
        try {
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
                $this->makeBuildingAvailableLogRecord($buildingAvailable);
                $buildingAvailable->update($updateData);
                $draft->delete();

                if (!empty($buildingAvailable->fire_protection_system)) {
                    $buildingAvailable->fire_protection_system = explode(',', $buildingAvailable->fire_protection_system);
                }
                if (!empty($buildingAvailable->above_market_tis)) {
                    $buildingAvailable->above_market_tis = explode(',', $buildingAvailable->above_market_tis);
                }
                return [
                    'success' => 'Draft deleted and applied to the original building.',
                    'data' => $buildingAvailable
                ];
            }

            $draft->update($validated);
            return ['success' => 'Draft updated successfully', 'data' => $draft];


        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'status' => 500];
        }
    }

    /**
     * @param Building $building
     * @param BuildingAvailable $buildingAvailable
     * @param string $state
     * @return array
     */
    public function deleteDraft(Building $building, BuildingAvailable $buildingAvailable, string $state): array
    {
        if ($buildingAvailable->building_id !== $building->id) {
            return ['error' => 'Building Available not found for this Building', 'status' => 404];
        }

        if ($buildingAvailable->building_state !== $state) {
            return ['error' => 'Invalid building state', 'status' => 403];
        }
        $draft = BuildingAvailable::where('building_available_id', $buildingAvailable->id)
            ->where('status', BuildingStatus::DRAFT->value)
            ->first();

        if (!$draft) {
            return ['error' => 'Draft not found', 'status' => 404];
        }
        $draft->delete();
        return ['success' => 'Draft deleted successfully.', 'data' => $draft];
    }

    /**
     * @param BuildingAvailable $buildingAvailable
     */
    private function makeBuildingAvailableLogRecord(BuildingAvailable $buildingAvailable): void
    {
        /*$logRecord = new BuildingAvailableLog($buildingAvailable->toArray());*/
        $logRecord = new BuildingAvailableLog($buildingAvailable->getAttributes());
        $logRecord['building_available_id'] = $buildingAvailable->id;
        $logRecord->save();
    }


}
