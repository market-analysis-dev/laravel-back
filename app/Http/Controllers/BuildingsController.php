<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\SubMarket;
use App\Models\IndustrialParks;
use App\Models\Buildings;
use App\Models\BuildingsAvailable;
use App\Models\BuildingsAbsorption;
use App\Models\BuildingsContacts;
use App\Models\BuildingsFeatures;
use App\Models\BuildingsImages;
// use Google\Service\Directory\Building;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BuildingsController
{
    /*
     * Inicialización de todos los select el formulario
     */
    /*
        public function index()
        {
            $mainReturn = [];
            // * cboClass
            $classData = DB::table('cat_class')->select('id AS value', 'className AS label')->get();
            $statusData = DB::table('cat_status')->select('id AS value', 'statusName AS label')->get();
            $industrialParkData = DB::table('cat_industrial_park')->select('id AS value', 'industrialParkName AS label')->get();
            $typeData = DB::table('cat_type')->select('id AS value', 'typeName AS label')->get();
            $ownerData = DB::table('cat_owner')->select('id AS value', 'ownerName AS label')->get();
            $developerData = DB::table('cat_developer')->select('id AS value', 'developerName AS label')->get();
            $developerData = DB::table('cat_developer')->select('id AS value', 'developerName AS label')->get();
            $regionData = DB::table('cat_region')->select('id AS value', 'regionName AS label')->get();
            $marketData = Market::select('id AS value', 'marketName AS label')->get();
            $marketData = SubMarket::select('id AS value', 'subMarketName AS label')->get();
            $loadingDoorData = DB::table('cat_loadingdoor')->select('id AS value', 'LoadingDoorName AS label')->get();
            $dealData = DB::table('cat_deal')->select('id AS value', 'dealName AS label')->get();
            $currencyData = DB::table('cat_currency')->select('id AS value', 'currencyName AS label')->get();
            $tenancyData = DB::table('cat_tenancy')->select('id AS value', 'tenancyName AS label')->get();
            $listingBrokerData = DB::table('cat_listingbroker')->select('id AS value', 'ListingBrokerName AS label')->get();

            $mainReturn['classData'] = $classData;
            $mainReturn['statusData'] = $statusData;
            $mainReturn['industrialParkData'] = $industrialParkData;
            $mainReturn['typeData'] = $typeData;
            $mainReturn['ownerData'] = $ownerData;
            $mainReturn['developerData'] = $developerData;
            $mainReturn['developerData'] = $developerData;
            $mainReturn['regionData'] = $regionData;
            $mainReturn['marketData'] = $marketData;
            $mainReturn['marketData'] = $marketData;
            $mainReturn['loadingDoorData'] = $loadingDoorData;
            $mainReturn['dealData'] = $dealData;
            $mainReturn['currencyData'] = $currencyData;
            $mainReturn['tenancyData'] = $tenancyData;
            $mainReturn['listingBrokerData'] = $listingBrokerData;

            return response()->json($mainReturn);
        }
    */

    // * Obteniendo todos los edificios
    public function getBuildingsTable()
    {
        $buildings = Buildings::select(
            'buildings.id as id',
            'buildings.building_name as name1',
            'buildings.createdAt as registered',
            'cat_markets.marketName as market',
            'cat_sub_markets.subMarketName as subMarket',
            'buildings_cat_states.buildingStateName as status',
            'cat_industrial_park.industrialParkName as industrialPark'
        )
        ->leftJoin('cat_markets', 'buildings.market_id', '=', 'cat_markets.id')
        ->leftJoin('cat_sub_markets', 'buildings.sub_market_id', '=', 'cat_sub_markets.id')
        ->leftJoin('cat_industrial_park', 'buildings.industrial_park_id', '=', 'cat_industrial_park.id')
        ->leftJoin('buildings_cat_states', 'buildings.builder_state_id', '=', 'buildings_cat_states.id')
        ->where('buildings.status', 'Activo')
        ->get();

        return response()->json($buildings);
    }

    // * Obteniendo todos los edificios pendientes de aprobar
    public function getBuildingsTableVoBo()
    {
        $buildings = Buildings::select(
            'buildings.id as id',
            'buildings.building_name as name1',
            'buildings.createdAt as registered',
            'cat_markets.marketName as market',
            'cat_sub_markets.subMarketName as subMarket',
            'buildings_cat_states.buildingStateName as status',
            'cat_industrial_park.industrialParkName as industrialPark'
        )
        ->leftJoin('cat_markets', 'buildings.market_id', '=', 'cat_markets.id')
        ->leftJoin('cat_sub_markets', 'buildings.sub_market_id', '=', 'cat_sub_markets.id')
        ->leftJoin('cat_industrial_park', 'buildings.industrial_park_id', '=', 'cat_industrial_park.id')
        ->leftJoin('buildings_cat_states', 'buildings.builder_state_id', '=', 'buildings_cat_states.id')
        ->where('vo_bo', '0')
        ->where('buildings.status', 'Activo')
        ->get();

        return response()->json($buildings);
    }

    // * Agregando catálogos nuevos a la base de datos
    public function saveRegister(Request $request)
    {
        // * Nombre de la tabla en la base de datos.
        $tableName = $request->tableName;
        $nameRegister = $request->nameRegister;
        $marketId = $request->marketId;
        $subMarketId = $request->subMarketId;

        // * obtener el nombre de la columna
        switch ($tableName) {
            case 'cat_industrial_park':
                
                $columnName = 'industrialParkName';

                if($marketId != '' && $subMarketId != ''){

                    DB::table($tableName)->insert([
                        $columnName => $nameRegister,
                        'marketId' => $marketId,
                        'subMarketId' => $subMarketId
                    ]);

                    return;

                } else {
                    return response()->json(['message' => 'Market or SubMarket Empty']);
                }

            break;

            case 'cat_developer':
                $columnName = 'developerName';
            break;

            case 'cat_loadingdoor':
                $columnName = 'LoadingDoorName';
            break;

            case 'cat_owner':
                $columnName = 'ownerName';
            break;

            case 'cat_broker':
                $columnName = 'brokerName';
            break;

            default:
                return response()->json(['message' => 'Table Name Error']);
            break;
            
        }

        // * INSERT del nuevo registro
        DB::table($tableName)->insert([
            $columnName => $nameRegister,
        ]);
        
    }

    // * Eliminando catálogos de la base de datos
    public function deleteRegister(Request $request)
    {
        $id = $request->id;
        $tableName = $request->tableName;

        DB::table($tableName)->where('id', $id)->delete();
    }

    // * Insertando un nuevo edificio
    public function insertBuilding(Request $request)
    {
        try {
            $buildingData = $this->decodeJsonData($request->input('buildingData'));
            $contactData = $this->decodeJsonData($request->input('contactData')); 

            DB::beginTransaction();
            
            $building = Buildings::create($this->prepareBuildingData($buildingData));
            
            if ($building) {
                $buildingId = $building->id;
                
                $this->createBuildingFeatures($buildingId, $buildingData);
                $this->createBuildingStateData($buildingId, $buildingData);
                
                DB::commit();
                return $this->successResponse('Building created successfully', $buildingId);
            }

            DB::rollBack();
            return $this->errorResponse("It was not possible to add this building");

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    // * Actualizando un edificio
    public function updateBuilding(Request $request, $buildingId)
    {
        try {
            if ($request->input('buildingData')) {
                return $this->updateBuildingData($request, $buildingId);
            }

            if ($request->input('contactData')) {
                return $this->updateBuildingContact($request, $buildingId);
            }

            return $this->errorResponse('No data provided for update', 400);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    // * Obteniendo un edificio por su ID
    public function getBuildingById($buildingId)
    {
        try {
            $mainReturn = $this->loadCatalogs();

            // Return only catalogs for new records
            if ($buildingId == 0) {
                return response()->json(['mainReturn' => $mainReturn]);
            }

            $building = $this->getBuildingWithRelations($buildingId);
            
            if (!$building) {
                return response()->json(['message' => 'Building not found'], 404);
            }

            $this->setSelectedCatalogValues($mainReturn, $building);
            
            $buildingData = $this->prepareBuildingResponseData($building);
            $contactData = $this->prepareContactData($building->buildingContacts);
            $images = $this->prepareImagesData($building->buildingImages);

            return response()->json([
                'mainReturn' => $mainReturn,
                'buildingData' => $buildingData,
                'contactData' => $contactData,
                'images' => $images
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    // * Testing upload files
    public function uploadFiles(Request $request)
    {
        $buildingId = $request->buildingId;

        // * Agregando las imagenes (de la pestaña de imagenes).

        if (!$request->hasFile('photoTypes')) {
            return response()->json([
                'title' => 'Error!',
                'text' => "Something's wrong...",
                'icon' => 'error'
            ]);
        }
        /*
            * 1 => Aerea
            * 2 => Galería
            * 3 => Portada
        */
        // * Iterando imagenes para poder diferenciar el tipo de imagen.
        foreach ($request->file('photoTypes') as $file) {

            // * Inicializando el tipo de imagen a 0 (no definido aún).
            $typePhoto = 0;

            $originalName = $file->getClientOriginalName();
            $stringOriginalName = pathinfo($originalName, PATHINFO_FILENAME);

            // * switch para definir el tipo de imagen a través del nombre.
            switch (strtolower($stringOriginalName)) {
                case 'portada': // * Portada.
                    $typePhoto = 3;
                break;
                
                default:
                    if (is_numeric($stringOriginalName)) { // * Galería.
                        $typePhoto = 2;
                    } else { // * Aerea
                        $typePhoto = 1;
                    }
                break;
            }

            $imageInsert = BuildingsImages::create([
                'buildingId' => $buildingId,
                'imageTypeId' => $typePhoto,
                'Image' => $originalName
            ]);

            // * validando que se inserta en la BD...
            if ($imageInsert) {
                $imagePath = $file->store('buildingsImages', 'public');
            }
        }

        return response()->json([
            'title' => 'Completed',
            'text' => "The files has been uploaded.",
            'icon' => 'success'
        ]);
    }

    /*
     *  |==========================|
     *  |====Funciones privadas====|
     *  |========================|
     */ 
    

    private function createBuildingFeatures($buildingId, $data)
    {
        BuildingsFeatures::create([
            'building_id' => $buildingId,
            'loading_door_id' => $data['loadingDoorId'],
            'lighting' => $data['lighting'],
            'ventilation' => $data['ventilation'],
            'transformer_capacity' => $data['transformerCapacity'],
            'construction_type' => $data['constructionType'],
            'construction_state' => $data['constructionState'],
            'roof_system' => $data['roofSystem'],
            'fire_protection_system' => $data['fireProtectionSystem'],
            'skylights_sf' => $data['sfSm'] == 0 ? $data['skylightsSf'] : $data['skylightsSf'] * 10.764,
            'coverage' => $data['coverage'],
        ]);
    }

    private function createBuildingStateData($buildingId, $data)
    {
        if ($data['builderStateId'] == 1) {
            $this->createBuildingAvailable($buildingId, $data);
        } elseif ($data['builderStateId'] == 2) {
            $this->createBuildingAbsorption($buildingId, $data);
        }
    }

    private function createBuildingAvailable($buildingId, $data)
    {
        BuildingsAvailable::create([
            'building_id' => $buildingId,
            'available_sf' => $data['sfSm'] == 0 ? $data['availableSf'] : $data['availableSf'] * 10.764,
            'minimum_space_sf' => $data['sfSm'] == 0 ? $data['minimumSpaceSf'] : $data['minimumSpaceSf'] * 10.764,
            'expansion_up_to_sf' => $data['sfSm'] == 0 ? $data['expansionUpToSf'] : $data['expansionUpToSf'] * 10.764,
            'dock_doors' => $data['dockDoors'],
            'drive_in_door' => $data['driveInDoor'],
            'floor_thickness' => $data['floorThickness'],
            'floor_resistance' => $data['floorResistance'],
            'truck_court' => $data['truckCourt'],
            'crossdock' => $data['crossdock'] ? 1 : 0,
            'shared_truck' => $data['sharedTruck'] ? 1 : 0,
            'building_dimensions_1' => $data['buildingDimensions1'],
            'building_dimensions_2' => $data['buildingDimensions2'],
            'bay_Size_1' => $data['baySize1'],
            'bay_Size_2' => $data['baySize2'],
            'columns_spacing_1' => $data['columnsSpacing1'],
            'columns_spacing_2' => $data['columnsSpacing2'],
            'knockouts_docks' => $data['knockoutsDocks'],
            'parking_space' => $data['parkingSpace'],
            'available_month' => explode("-", $data['availableMonth'])[1],
            'available_year' => $data['availableYear'],
            'min_lease' => $data['minLease'],
            'max_lease' => $data['maxLease']
        ]);
    }

    private function createBuildingAbsorption($buildingId, $data)
    {
        BuildingsAbsorption::create([
            'building_id' => $buildingId,
            'lease_term_month' => $data['leaseTermMonth'],
            'asking_rate_shell' => $data['askingRateShell'],
            'closing_rate' => $data['closingRate'],
            'KVAS' => $data['KVAS'],
            'closing_quarter' => $data['closingQuarter'],
            'lease_up' => $data['leaseUp'],
            'month' => $data['month'],
            'new_construction' => $data['newConstruction'],
            'starting_construction' => $data['startingConstruction'],
            'tenant_id' => $data['tenantId'],
            'industry_id' => $data['industryId'],
            'final_use_id' => $data['finalUseId'],
            'shelter_id' => $data['shelterId'],
            'copany_type_id' => $data['copanyTypeId'],
        ]);
    }

    private function updateBuildingData(Request $request, $buildingId)
    {
        $buildingData = $this->decodeJsonData($request->input('buildingData'));
        $building = Buildings::findOrFail($buildingId);
        
        $building->update($this->prepareBuildingData($buildingData));
        $this->updateBuildingFeatures($buildingId, $buildingData);
        
        return $this->successResponse('Building updated successfully', $buildingId);
    }

    private function updateBuildingContact(Request $request, $buildingId)
    {
        $contactData = $this->decodeJsonData($request->input('contactData'));
        
        BuildingsContacts::updateOrCreate(
            ['building_id' => $buildingId],
            $this->prepareContactData($contactData)
        );

        return $this->successResponse('Contact updated successfully', $buildingId);
    }

    private function prepareBuildingData($data)
    {
        return [
            'vo_bo' => 0,
            'builder_state_id' => $data['builderStateId'],
            'sf_sm' => $data['sfSm'],
            'building_name' => $data['buildingName'],
            'class_id' => $data['classId'],
            'building_size_sf' => $data['sfSm'] == 0 ? $data['buildingSizeSf'] : $data['buildingSizeSf'] * 10.764,
            'expansion_land' => $data['expansionLand'],
            'status_id' => $data['statusId'],
            'industrial_park_id' => $data['industrialParkId'],
            'type_id' => $data['typeId'],
            'owner_id' => $data['ownerId'],
            'developer_id' => $data['developerId'],
            'broker_id' => $data['brokerId'],
            'builder_id' => $data['builderId'],
            'region_id' => $data['regionId'],
            'market_id' => $data['marketId'],
            'sub_market_id' => $data['subMarketId'],
            'deal_id' => $data['dealId'],
            'currency_id' => $data['currencyId'],
            'sale_price_usd' => $data['salePriceUsd'],
            'tenancy_id' => $data['tenancyId'],
            'latitud' => $data['latitud'],
            'longitud' => $data['longitud'],
            'year_built' => $data['yearBuilt'],
            'clear_height' => $data['clearHeight'],
            'offices_space' => $data['officesSpace'],
            'crane' => $data['crane'] ? 1 : 0,
            'hvac' => $data['hvac'] ? 1 : 0,
            'rail_spur' => $data['railSpur'] ? 1 : 0,
            'sprinklers' => $data['sprinklers'] ? 1 : 0,
            'office' => $data['office'] ? 1 : 0,
            'leed' => $data['leed'] ? 1 : 0,
            'total_land' => $data['totalLand'],
            'hvac_production_area' => $data['hvacProductionArea'],
            'status' => 'Activo'
        ];
    }

    private function prepareContactData($data)
    {
        return [
            'contact_name' => $data['contact'],
            'contact_phone' => $data['phone'],
            'contact_email' => $data['email'],
            'contact_comments' => $data['comments']
        ];
    }

    private function updateBuildingFeatures($buildingId, $data)
    {
        BuildingsFeatures::updateOrCreate(
            ['building_id' => $buildingId],
            [
                'loading_door_id' => $data['loadingDoorId'],
                'lighting' => $data['lighting'],
                'ventilation' => $data['ventilation'],
                'transformer_capacity' => $data['transformerCapacity'],
                'construction_type' => $data['constructionType'],
                'construction_state' => $data['constructionState'],
                'roof_system' => $data['roofSystem'],
                'fire_protection_system' => $data['fireProtectionSystem'],
                'skylights_sf' => $data['skylightsSf'],
                'coverage' => $data['coverage'],
            ]
        );
    }

    private function decodeJsonData($jsonData)
    {
        $decoded = json_decode($jsonData, true);
        if (!$decoded) {
            throw new \Exception('Invalid JSON data');
        }
        return $decoded;
    }

    private function successResponse($message, $buildingId)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'building_id' => $buildingId
        ], 200);
    }

    private function errorResponse($message, $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    private function prepareAvailableData($buildingAvailable)
    {
        if (!$buildingAvailable) {
            return [];
        }

        return [
            'availableSf' => $buildingAvailable->available_sf,
            'minimumSpaceSf' => $buildingAvailable->minimum_space_sf,
            'expansionUpToSf' => $buildingAvailable->expansion_up_to_sf,
            'dockDoors' => $buildingAvailable->dock_doors,
            'driveInDoor' => $buildingAvailable->drive_in_door,
            'floorThickness' => $buildingAvailable->floor_thickness,
            'floorResistance' => $buildingAvailable->floor_resistance,
            'truckCourt' => $buildingAvailable->truck_court,
            'crossdock' => (bool)$buildingAvailable->crossdock,
            'sharedTruck' => (bool)$buildingAvailable->shared_truck,
            'buildingDimensions1' => $buildingAvailable->building_dimensions_1,
            'buildingDimensions2' => $buildingAvailable->building_dimensions_2,
            'baySize1' => $buildingAvailable->bay_Size_1,
            'baySize2' => $buildingAvailable->bay_Size_2,
            'columnsSpacing1' => $buildingAvailable->columns_spacing_1,
            'columnsSpacing2' => $buildingAvailable->columns_spacing_2,
            'knockoutsDocks' => $buildingAvailable->knockouts_docks,
            'parkingSpace' => $buildingAvailable->parking_space,
            'availableMonth' => $buildingAvailable->available_month,
            'availableYear' => $buildingAvailable->available_year,
            'minLease' => $buildingAvailable->min_lease,
            'maxLease' => $buildingAvailable->max_lease
        ];
    }

    private function prepareAbsorptionData($buildingAbsorption)
    {
        if (!$buildingAbsorption) {
            return [];
        }

        return [
            'leaseTermMonth' => $buildingAbsorption->lease_term_month,
            'askingRateShell' => $buildingAbsorption->asking_rate_shell,
            'closingRate' => $buildingAbsorption->closing_rate,
            'KVAS' => $buildingAbsorption->KVAS,
            'closingQuarter' => $buildingAbsorption->closing_quarter,
            'leaseUp' => $buildingAbsorption->lease_up,
            'month' => $buildingAbsorption->month,
            'newConstruction' => $buildingAbsorption->new_construction,
            'startingConstruction' => $buildingAbsorption->starting_construction,
            'tenantId' => $buildingAbsorption->tenant_id,
            'industryId' => $buildingAbsorption->industry_id,
            'finalUseId' => $buildingAbsorption->final_use_id,
            'shelterId' => $buildingAbsorption->shelter_id,
            'copanyTypeId' => $buildingAbsorption->copany_type_id
        ];
    }

    private function loadCatalogs()
    {
        $catalogs = [
            'statesData' => ['buildings_cat_states', 'buildingStateName'],
            'classData' => ['cat_class', 'className'],
            'statusData' => ['cat_status', 'statusName'],
            'regionData' => ['cat_region', 'regionName'],
            'ownerData' => ['cat_owner', 'ownerName'],
            'developerData' => ['cat_developer', 'developerName'],
            'builderData' => ['cat_builder', 'builderName'],
            'brokerData' => ['cat_broker', 'brokerName'],
            'listingBrokerData' => ['cat_listingbroker', 'ListingBrokerName'],
            'currencyData' => ['cat_currency', 'currencyName'],
            'tenancyData' => ['cat_tenancy', 'tenancyName'],
            'dealData' => ['cat_deal', 'dealName'],
            'typeData' => ['cat_type', 'typeName'],
            'loadingDoorData' => ['cat_loadingdoor', 'LoadingDoorName'],
        ];

        $mainReturn = [];
        foreach ($catalogs as $key => $value) {
            $mainReturn[$key] = DB::table($value[0])
                ->select('id AS value', $value[1] . ' AS label')
                ->get();
        }

        // Handle Market->SubMarket->IndustrialPark relationship separately
        $mainReturn['marketData'] = $this->getMarketHierarchy();

        return $mainReturn;
    }
    
    private function getMarketHierarchy()
    {
        $marketData = Market::select('id AS value', 'marketName AS label')->get();
        
        foreach ($marketData as $market) {
            $subMarkets = SubMarket::select('id AS value', 'subMarketName AS label')
                ->where('marketId', $market->value)
                ->get();

            foreach ($subMarkets as $subMarket) {
                $subMarket->industrialParks = IndustrialParks::select('id AS value', 'industrialParkName AS label')
                    ->where('marketId', $market->value)
                    ->where('subMarketId', $subMarket->value)
                    ->get();
            }

            $market->subMarkets = $subMarkets;
        }

        return $marketData;
    }
    
    private function getBuildingWithRelations($buildingId)
    {
        return Buildings::with([
            'buildingAvailable',
            'buildingAbsorption',
            'buildingContacts',
            'buildingFeatures',
            'buildingImages'
        ])->find($buildingId);
    }
    
    private function setSelectedCatalogValues(&$mainReturn, $building)
    {
        $catalogMappings = [
            'statesData' => 'builder_state_id',
            'classData' => 'class_id',
            'statusData' => 'status_id',
            'regionData' => 'region_id',
            'ownerData' => 'owner_id',
            'developerData' => 'developer_id',
            'builderData' => 'builder_id',
            'brokerData' => 'broker_id',
            'currencyData' => 'currency_id',
            'tenancyData' => 'tenancy_id',
            'dealData' => 'deal_id',
            'typeData' => 'type_id'
        ];

        foreach ($catalogMappings as $catalog => $field) {
            $this->markSelectedValue($mainReturn[$catalog], $building->$field);
        }

        $this->setMarketHierarchySelection($mainReturn['marketData'], $building);
    }

    private function markSelectedValue(&$catalog, $selectedId)
    {
        if ($catalog->contains('value', $selectedId)) {
            $index = $catalog->search(function($item) use ($selectedId) {
                return $item->value === $selectedId;
            });
            $catalog[$index]->selected = "true";
        }
    }
    
    private function setMarketHierarchySelection(&$marketData, $building)
    {
        foreach ($marketData as $market) {
            if ($market->value === $building->market_id) {
                $market->selected = "true";
                
                foreach ($market->subMarkets as $subMarket) {
                    if ($subMarket->value === $building->sub_market_id) {
                        $subMarket->selected = "true";
                        
                        foreach ($subMarket->industrialParks as $park) {
                            if ($park->value === $building->industrial_park_id) {
                                $park->selected = "true";
                            }
                        }
                    }
                }
            }
        }
    }
    
    private function prepareBuildingResponseData($building)
    {
        $data = [
            'buildingName' => $building->building_name,
            'smSf' => $building->sf_sm == 0 ? false : true,
            'buildingSizeSf' => $building->sf_sm == 0 ? 
                $building->building_size_sf : 
                $building->building_size_sf / 10.764,

        ];

        if ($building->buildingFeatures) {
            $data = array_merge($data, [
                'loadingDoorId' => $building->buildingFeatures->loading_door_id,
                'lighting' => $building->buildingFeatures->lighting,
                // Add other feature fields...
            ]);
        }

        // Add state-specific data
        if ($building->builder_state_id == 1 && $building->buildingAvailable) {
            $data = array_merge($data, $this->prepareAvailableData($building->buildingAvailable));
        } elseif ($building->builder_state_id == 2 && $building->buildingAbsorption) {
            $data = array_merge($data, $this->prepareAbsorptionData($building->buildingAbsorption));
        }

        return $data;
    }
    
    private function prepareImagesData($images)
    {
        return $images->map(function($image) {
            return [
                'id' => $image->id,
                'imageTypeId' => $image->imageTypeId,
                'image' => $image->Image
            ];
        });
    }

}
