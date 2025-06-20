<?php

namespace App\Services;

use App\Models\{
    Building, BuildingAvailable,
    Region, Market, SubMarket, Developer, IndustrialPark,
    Tenant, Industry, Country, Broker, Shelter
};
use Illuminate\Support\Facades\DB;
use App\Enums\BuildingState;

class BuildingAvailabilityImportService
{
    protected array $regions = [];
    protected array $markets = [];
    protected array $subMarkets = [];
    protected array $builders = [];
    protected array $industrialParks = [];
    protected array $developers = [];
    protected array $owners = [];

    protected array $tenants = [];
    protected array $industries = [];
    protected array $countries = [];
    protected array $brokers = [];
    protected array $shelters = [];

    protected array $errors = [];

    protected int $importedBuildings = 0;
    protected int $updatedBuildings = 0;
    protected int $importedAvailability = 0;
    protected int $updatedAvailability = 0;

    public function __construct()
    {
        $this->loadReferenceData();
    }

    protected function loadReferenceData(): void
    {
        $this->regions = Region::pluck('id', 'name')->toArray();
        $this->markets = Market::pluck('id', 'name')->toArray();
        $this->subMarkets = SubMarket::pluck('id', 'name')->toArray();
        $this->builders = Developer::pluck('id', 'name')->toArray();
        $this->industrialParks = IndustrialPark::pluck('id', 'name')->toArray();
        $this->developers = Developer::pluck('id', 'name')->toArray();
        $this->owners = Developer::pluck('id', 'name')->toArray();

        $this->tenants = Tenant::pluck('id', 'name')->toArray();
        $this->industries = Industry::pluck('id', 'name')->toArray();
        $this->countries = Country::pluck('id', 'name')->toArray();
        $this->brokers = Broker::pluck('id', 'name')->toArray();
        $this->shelters = Shelter::pluck('id', 'name')->toArray();
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

    protected function getIdByName(array $lookupArray, ?string $value, string $label, int $rowIndex): ?int
    {
        if (!$value) {
            return null;
        }

        if (!isset($lookupArray[$value])) {
            $this->errors[] = "Row " . ($rowIndex + 2) . ": $label \"$value\" not found.";
            return null;
        }

        return $lookupArray[$value];
    }

    public function importFromCsvPath(string $path): array
    {
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', array_shift($csv));

        foreach ($csv as $index => $row) {
            try {
                $data = array_combine($header, $row);
                $this->normalizeNulls($data);

                if (empty($data['building_name']) || empty($data['ba_avl_date'])) {
                    $this->errors[] = "Row " . ($index + 2) . ": Missing 'building_name' or 'ba_avl_date'";
                    continue;
                }

                $buildingData = [
                    'region_id' => $this->regions[$data['region'] ?? ''] ?? null,
                    'market_id' => $this->markets[$data['market'] ?? ''] ?? null,
                    'sub_market_id' => $this->subMarkets[$data['sub_market'] ?? ''] ?? null,
                    'builder_id' => $this->builders[$data['builder'] ?? ''] ?? null,
                    'industrial_park_id' => $this->industrialParks[$data['industrial_park'] ?? ''] ?? null,
                    'developer_id' => $this->developers[$data['developer'] ?? ''] ?? null,
                    'owner_id' => $this->owners[$data['owner'] ?? ''] ?? null,

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

                $building = Building::where('building_name', $buildingData['building_name'])
                    ->where('region_id', $buildingData['region_id'])
                    ->where('market_id', $buildingData['market_id'])
                    ->where('sub_market_id', $buildingData['sub_market_id'])
                    ->where('builder_id', $buildingData['builder_id'])
                    ->first();

                if ($building) {
                    $building->fill($buildingData)->save();
                    $this->updatedBuildings++;
                } else {
                    $building = Building::create($buildingData);
                    $this->importedBuildings++;
                }

                $availabilityData = [];
                foreach ($data as $key => $value) {
                    if (str_starts_with($key, 'ba_')) {
                        $field = substr($key, 3);
                        $availabilityData[$field] = $value;
                    }
                }

                $availabilityData['building_id'] = $building->id;

                $availabilityData['abs_tenant_id'] = $this->getIdByName($this->tenants, $data['ba_avl_tenant_name'] ?? null, 'Tenant', $index);
                $availabilityData['abs_industry_id'] = $this->getIdByName($this->industries, $data['ba_avl_industry_name'] ?? null, 'Industry', $index);
                $availabilityData['abs_country_id'] = $this->getIdByName($this->countries, $data['ba_avl_country_name'] ?? null, 'Country', $index);
                $availabilityData['broker_id'] = $this->getIdByName($this->brokers, $data['ba_avl_broker_name'] ?? null, 'Broker', $index);
                $availabilityData['abs_shelter_id'] = $this->getIdByName($this->shelters, $data['ba_avl_shelter_name'] ?? null, 'Shelter', $index);

                $this->normalizeNulls($availabilityData);

                if (!empty($availabilityData['size_sf']) && !empty($building->building_size_sf)) {
                    if ((float)$availabilityData['size_sf'] > (float)$building->building_size_sf) {
                        $availabilityData['size_sf'] = $building->building_size_sf;
                    }
                }

                $existingAvailability = BuildingAvailable::where('building_id', $building->id)
                    ->where('building_state', BuildingState::AVAILABILITY->value)
                    ->first();

                if ($existingAvailability) {
                    $existingAvailability->fill($availabilityData)->save();
                    $this->updatedAvailability++;
                } else {
                    BuildingAvailable::create($availabilityData);
                    $this->importedAvailability++;
                }
            } catch (\Throwable $e) {
                $this->errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        return [
            'imported_buildings' => $this->importedBuildings,
            'updated_buildings' => $this->updatedBuildings,
            'imported_availability' => $this->importedAvailability,
            'updated_availability' => $this->updatedAvailability,
            'errors' => $this->errors,
        ];
    }
}
