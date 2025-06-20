<?php


namespace App\Services;

use App\Models\{
    Building, Region, Market, SubMarket, Developer, IndustrialPark,
    Tenant, Industry, Country, Broker, Shelter, BuildingAvailable,
};
use Illuminate\Http\UploadedFile;
use App\Enums\BuildingState;

class BuildingAbsorptionImportService
{
    protected array $errors = [];

    public function importFromFile(UploadedFile $file): array
    {
        $path = $file->getRealPath();
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', array_shift($csv));

        $importedBuildings = 0;
        $updatedBuildings = 0;
        $importedAbsorption = 0;
        $updatedAbsorption = 0;
        $this->errors = [];

        foreach ($csv as $index => $row) {
            try {
                $data = array_combine($header, $row);
                $this->normalizeNulls($data);

                if (empty($data['building_name']) || empty($data['ba_avl_date'])) {
                    $this->errors[] = "Row " . ($index + 2) . ": Missing 'building_name' or 'ba_avl_date'";
                    continue;
                }

                // Получаем данные здания
                $buildingData = $this->prepareBuildingData($data);

                // Ищем здание по уникальным полям
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

                $absorptionData = $this->prepareAbsorptionData($data, $building, $index);

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
                $this->errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        return [
            'imported_buildings' => $importedBuildings,
            'updated_buildings' => $updatedBuildings,
            'imported_absorption' => $importedAbsorption,
            'updated_absorption' => $updatedAbsorption,
            'errors' => $this->errors,
        ];
    }

    protected function normalizeNulls(array &$data): void
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                $this->normalizeNulls($value);
            } else {
                if (is_string($value) && strtoupper($value) === 'NULL') {
                    $value = null;
                }
            }
        }
    }

    protected function getIdByName(string $modelClass, string $column, ?string $value, string $label, int $rowIndex): ?int
    {
        if (!$value) return null;

        $record = $modelClass::where($column, $value)->first();

        if (!$record) {
            $this->errors[] = "Row " . ($rowIndex + 2) . ": $label \"$value\" not found.";
            return null;
        }

        return $record->id;
    }

    protected function prepareBuildingData(array $data): array
    {
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

        $this->normalizeNulls($buildingData);

        return $buildingData;
    }

    protected function prepareAbsorptionData(array $data, Building $building, int $rowIndex): array
    {
        $absorptionData = [];

        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'ba_')) {
                $field = substr($key, 3);
                $absorptionData[$field] = $value;
            }
        }

        $absorptionData['building_id'] = $building->id;
        $absorptionData['abs_tenant_id'] = $this->getIdByName(Tenant::class, 'name', $data['ba_avl_tenant_name'] ?? null, 'Tenant', $rowIndex);
        $absorptionData['abs_industry_id'] = $this->getIdByName(Industry::class, 'name', $data['ba_avl_industry_name'] ?? null, 'Industry', $rowIndex);
        $absorptionData['abs_country_id'] = $this->getIdByName(Country::class, 'name', $data['ba_avl_country_name'] ?? null, 'Country', $rowIndex);
        $absorptionData['broker_id'] = $this->getIdByName(Broker::class, 'name', $data['ba_avl_broker_name'] ?? null, 'Broker', $rowIndex);
        $absorptionData['abs_shelter_id'] = $this->getIdByName(Shelter::class, 'name', $data['ba_avl_shelter_name'] ?? null, 'Shelter', $rowIndex);

        $this->normalizeNulls($absorptionData);

        if (!empty($absorptionData['size_sf']) && !empty($building->building_size_sf)) {
            if ((float)$absorptionData['size_sf'] > (float)$building->building_size_sf) {
                $absorptionData['size_sf'] = $building->building_size_sf;
            }
        }

        return $absorptionData;
    }
}

