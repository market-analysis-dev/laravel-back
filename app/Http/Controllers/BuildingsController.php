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

    public function getBuildingsTable()
    {
        $buildings = Buildings::select(
            'buildings.id as id',
            'buildings.building_name as name1',
            'buildings.createdAt as registered',
            'cat_markets.marketName as market',
            'cat_submarkets.subMarketName as subMarket',
            'buildings_cat_states.buildingStateName as status',
            'cat_industrial_park.industrialParkName as industrialPark'
        )
        ->leftJoin('cat_markets', 'buildings.market_id', '=', 'cat_markets.id')
        ->leftJoin('cat_submarkets', 'buildings.sub_market_id', '=', 'cat_submarkets.id')
        ->leftJoin('cat_industrial_park', 'buildings.industrial_park_id', '=', 'cat_industrial_park.id')
        ->leftJoin('buildings_cat_states', 'buildings.builder_state_id', '=', 'buildings_cat_states.id')
        ->where('buildings.status', 'Activo')
        ->get();

        return response()->json($buildings);
    }

    public function getBuildingsTableVoBo()
    {
        $buildings = Buildings::select(
            'buildings.id as id',
            'buildings.building_name as name1',
            'buildings.createdAt as registered',
            'cat_markets.marketName as market',
            'cat_submarkets.subMarketName as subMarket',
            'buildings_cat_states.buildingStateName as status',
            'cat_industrial_park.industrialParkName as industrialPark'
        )
        ->leftJoin('cat_markets', 'buildings.market_id', '=', 'cat_markets.id')
        ->leftJoin('cat_submarkets', 'buildings.sub_market_id', '=', 'cat_submarkets.id')
        ->leftJoin('cat_industrial_park', 'buildings.industrial_park_id', '=', 'cat_industrial_park.id')
        ->leftJoin('buildings_cat_states', 'buildings.builder_state_id', '=', 'buildings_cat_states.id')
        ->where('vo_bo', '0')
        ->where('buildings.status', 'Activo')
        ->get();

        return response()->json($buildings);
    }

    /*
     * Guardando nuevo registro en la base de datos
    */

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

    public function deleteRegister(Request $request)
    {
        $id = $request->id;
        $tableName = $request->tableName;

        DB::table($tableName)->where('id', $id)->delete();
    }

    public function insertBuilding(Request $request)
    {
        
        try {
            $buildingDataJSON = $request->input('buildingData');
            $buildingData = json_decode($buildingDataJSON, true);
            $contactDataJSON = $request->input('contactData');
            $contactData = json_decode($contactDataJSON, true); 

            // Validar que los datos JSON se decodificaron correctamente
            // ! Creo que se tendrá que quitar el if
            if (!$buildingData || !$contactData) {
                throw new \Exception('Error al decodificar los datos JSON');
            }

            // Crear el building principal
            $building = Buildings::create([
                'vo_bo' => 0,
                'builder_state_id' => $buildingData['builderStateId'],
                'sf_sm' => $buildingData['sfSm'],
                'building_name' => $buildingData['buildingName'],
                'class_id' => $buildingData['classId'],
                'building_size_sf' => $buildingData['buildingSizeSf'],
                'expansion_land' => $buildingData['expansionLand'],
                'status_id' => $buildingData['statusId'],
                'industrial_park_id' => $buildingData['industrialParkId'],
                'type_id' => $buildingData['typeId'],
                'owner_id' => $buildingData['ownerId'],
                'developer_id' => $buildingData['developerId'],
                'broker_id' => $buildingData['brokerId'],
                'builder_id' => $buildingData['builderId'],
                'region_id' => $buildingData['regionId'],
                'market_id' => $buildingData['marketId'],
                'sub_market_id' => $buildingData['subMarketId'],
                'deal_id' => $buildingData['dealId'],
                'currency_id' => $buildingData['currencyId'],
                'sale_price_usd' => $buildingData['salePriceUsd'],
                'tenancy_id' => $buildingData['tenancyId'],
                'latitud' => $buildingData['latitud'],
                'longitud' => $buildingData['longitud'],
                'year_built' => $buildingData['yearBuilt'],
                'clear_height' => $buildingData['clearHeight'],
                'offices_space' => $buildingData['officesSpace'],
                'crane' => $buildingData['crane'] ? 1 : 0,
                'hvac' => $buildingData['hvac'] ? 1 : 0,
                'rail_spur' => $buildingData['railSpur'] ? 1 : 0,
                'sprinklers' => $buildingData['sprinklers'] ? 1 : 0,
                'office' => $buildingData['office'] ? 1 : 0,
                'leed' => $buildingData['leed'] ? 1 : 0,
                'total_land' => $buildingData['totalLand'],
                'hvac_production_area' => $buildingData['hvacProductionArea'],
                'status' => 'Activo'
            ]);

            if ($building) {

                $buildingId = $building->id;

                // ! quitar en insert de las imagenes
                /*
                    // Agregar las imágenes (de la pestaña de imagenes)
                    if ($request->hasFile('photoTypes')) {
                        foreach ($request->file('photoTypes') as $file) {
                            // Inicializando el tipo de imagen a 0 (no definido aún)
                            $typePhoto = 0;

                            $originalName = $file->getClientOriginalName();
                            $stringOriginalName = pathinfo($originalName, PATHINFO_FILENAME);

                            // switch para definir el tipo de imagen a través del nombre
                            switch (strtolower($stringOriginalName)) {
                                case 'portada': // Portada
                                    $typePhoto = 3;
                                    break;
                                default:
                                    if (is_numeric($stringOriginalName)) { // Galería
                                        $typePhoto = 2;
                                    } else { // Aerea
                                        $typePhoto = 1;
                                    }
                                    break;
                            }

                            $imageInsert = BuildingsImages::create([
                                'buildingId' => $buildingId,
                                'imageTypeId' => $typePhoto,
                                'Image' => $originalName
                            ]);

                            // validando que se inserta en la BD...
                            if ($imageInsert) {
                                $imagePath = $file->store('buildingsImages', 'public');
                            }
                        }
                    }

                    // Agregar las imágenes (de la pestañas de extras [imagenes 360])
                    if ($request->hasFile('aroundImages')) {
                        foreach ($request->file('aroundImages') as $file) {
                            $originalName = $file->getClientOriginalName();

                            $imageInsert = BuildingsImages::create([
                                'buildingId' => $buildingId,
                                'imageTypeId' => 0,
                                'Image' => $originalName
                            ]);

                            // validando que se inserta en la BD...
                            if ($imageInsert) {
                                $imagePath = $file->store('buildingsImages', 'public');
                            }
                        }
                    }
                */

                // Crear el contacto
                BuildingsContacts::create([
                    'building_id' => $buildingId,
                    'contact_name' => $contactData['contact'],
                    'contact_phone' => $contactData['phone'],
                    'contact_email' => $contactData['email'],
                    'contact_comments' => $contactData['comments'],
                ]);

                // Crear features
                BuildingsFeatures::create([
                    'building_id' => $buildingId,
                    'loading_door_id' => $buildingData['loadingDoorId'],
                    'lighting' => $buildingData['lighting'],
                    'ventilation' => $buildingData['ventilation'],
                    'transformer_capacity' => $buildingData['transformerCapacity'],
                    'construction_type' => $buildingData['constructionType'],
                    'construction_state' => $buildingData['constructionState'],
                    'roof_system' => $buildingData['roofSystem'],
                    'fire_protection_system' => $buildingData['fireProtectionSystem'],
                    'skylights_sf' => $buildingData['skylightsSf'],
                    'coverage' => $buildingData['coverage'],
                ]);

                // Procesar según el builder state
                if ($buildingData['builderStateId'] == 1) { // Availability
                    BuildingsAvailable::create([
                        'building_id' => $buildingId,
                        'available_sf' => $buildingData['availableSf'],
                        'minimum_space_sf' => $buildingData['minimumSpaceSf'],
                        'expansion_up_to_sf' => $buildingData['expansionUpToSf'],
                        'dock_doors' => $buildingData['dockDoors'],
                        'drive_in_door' => $buildingData['driveInDoor'],
                        'floor_thickness' => $buildingData['floorThickness'],
                        'floor_resistance' => $buildingData['floorResistance'],
                        'truck_court' => $buildingData['truckCourt'],
                        'crossdock' => $buildingData['crossdock'] ? 1 : 0,
                        'shared_truck' => $buildingData['sharedTruck'] ? 1 : 0,
                        'building_dimensions_1' => $buildingData['buildingDimensions1'],
                        'building_dimensions_2' => $buildingData['buildingDimensions2'],
                        'bay_Size_1' => $buildingData['baySize1'],
                        'bay_Size_2' => $buildingData['baySize2'],
                        'columns_spacing_1' => $buildingData['columnsSpacing1'],
                        'columns_spacing_2' => $buildingData['columnsSpacing2'],
                        'knockouts_docks' => $buildingData['knockoutsDocks'],
                        'parking_space' => $buildingData['parkingSpace'],
                        'available_month' => explode("-", $buildingData['availableMonth'])[1],
                        'available_year' => $buildingData['availableYear'],
                        'min_lease' => $buildingData['minLease'],
                        'max_lease' => $buildingData['maxLease']
                    ]);
                } elseif ($buildingData['builderStateId'] == 2) { // Absorption
                    BuildingsAbsorption::create([
                        'building_id' => $buildingId,
                        'lease_term_month' => $buildingData['leaseTermMonth'],
                        'asking_rate_shell' => $buildingData['askingRateShell'],
                        'closing_rate' => $buildingData['closingRate'],
                        'KVAS' => $buildingData['KVAS'],
                        'closing_quarter' => $buildingData['closingQuarter'],
                        'lease_up' => $buildingData['leaseUp'],
                        'month' => $buildingData['month'],
                        'new_construction' => $buildingData['newConstruction'],
                        'starting_construction' => $buildingData['startingConstruction'],
                        'tenant_id' => $buildingData['tenantId'],
                        'industry_id' => $buildingData['industryId'],
                        'final_use_id' => $buildingData['finalUseId'],
                        'shelter_id' => $buildingData['shelterId'],
                        'copany_type_id' => $buildingData['copanyTypeId'],
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Building created successfully',
                    'building_id' => $buildingId
                ], 201);

            } else {
                return response()->json([
                    'title' => 'Error',
                    'text' => "It was not possible to add this building",
                    'icon' => 'error'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el building',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateBuilding(Request $request, $buildingId)
    {

        $buildingDataJSON = $request->input('buildingData');
        $buildingData = json_decode($buildingDataJSON, true);
        $contactDataJSON = $request->input('contactData');
        $contactData = json_decode($contactDataJSON, true);

        if ($request->input('buildingData')) {
            try {

                if (!$buildingData) {
                    throw new \Exception('Error al decodificar los datos JSON');
                }

                $building = Buildings::find($buildingId);

                $building->update([
                    'vo_bo' => $buildingData['voBo'],
                    'builder_state_id' => $buildingData['builderStateId'],
                    'sf_sm' => $buildingData['sfSm'],
                    'building_name' => $buildingData['buildingName'],
                    'class_id' => $buildingData['classId'],
                    'building_size_sf' => $buildingData['buildingSizeSf'],
                    'expansion_land' => $buildingData['expansionLand'],
                    'status_id' => $buildingData['statusId'],
                    'industrial_park_id' => $buildingData['industrialParkId'],
                    'type_id' => $buildingData['typeId'],
                    'owner_id' => $buildingData['ownerId'],
                    'developer_id' => $buildingData['developerId'],
                    'broker_id' => $buildingData['brokerId'],
                    'builder_id' => $buildingData['builderId'],
                    'region_id' => $buildingData['regionId'],
                    'market_id' => $buildingData['marketId'],
                    'sub_market_id' => $buildingData['subMarketId'],
                    'deal_id' => $buildingData['dealId'],
                    'currency_id' => $buildingData['currencyId'],
                    'sale_price_usd' => $buildingData['salePriceUsd'],
                    'tenancy_id' => $buildingData['tenancyId'],
                    'latitud' => $buildingData['latitud'],
                    'longitud' => $buildingData['longitud'],
                    'year_built' => $buildingData['yearBuilt'],
                    'clear_height' => $buildingData['clearHeight'],
                    'offices_space' => $buildingData['officesSpace'],
                    'crane' => $buildingData['crane'],
                    'hvac' => $buildingData['hvac'],
                    'rail_spur' => $buildingData['railSpur'],
                    'sprinklers' => $buildingData['sprinklers'],
                    'office' => $buildingData['office'],
                    'leed' => $buildingData['leed'],
                    'total_land' => $buildingData['totalLand'],
                    'hvac_production_area' => $buildingData['hvacProductionArea'],
                    'status' => $buildingData['statusId'],
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Building updated successfully',
                    'building_id' => $buildingId
                ], 200);
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al decodificar los datos JSON',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        if ($request->input('contactData')) {

            try {
                
                $buildingContact = BuildingsContacts::where('building_id', $buildingId)->first();
    
                $buildingContact->update([
                    'contact_name' => $contactData['contact'],
                    'contact_phone' => $contactData['phone'],
                    'contact_email' => $contactData['email'],
                    'contact_comments' => $contactData['comments'],
                ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Building contact updated successfully',
                    'building_id' => $buildingId
                ], 200);

            } catch (\Throwable $th) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al decodificar los datos JSON',
                    'error' => $th->getMessage()
                ], 500);
            }
        }
    }

    public function getBuildingById($buildingId)
    {

        /*
         * Primero cargamos todos los catalogos de los combos
         */
        $mainReturn = [];
        $statesData = DB::table('buildings_cat_states')->select('id AS value', 'buildingStateName AS label')->get();
        $classData = DB::table('cat_class')->select('id AS value', 'className AS label')->get();
        $statusData = DB::table('cat_status')->select('id AS value', 'statusName AS label')->get();
        $regionData = DB::table('cat_region')->select('id AS value', 'regionName AS label')->get();
        $marketData = Market::select('id AS value', 'marketName AS label')->get();
        // * Ligando Market->SubMarket->IndustrialPark
        foreach ($marketData as $x => $market) {
            $marketId = $market->value;
            $subMarkets = SubMarket::select('id AS value', 'subMarketName AS label')
                ->where('marketId', $marketId)
                ->get();

            $marketData[$x]->subMarkets = $subMarkets;

            foreach ($subMarkets as $y => $subMarket) {
                $subMarketId = $subMarket->value;
                $industrialParks = IndustrialParks::select('id AS value', 'industrialParkName AS label')
                    ->where('marketId', $marketId)
                    ->where('subMarketId', $subMarketId)
                    ->get();

                $subMarkets[$y]->industrialParks = $industrialParks;
            }
        }

        $ownerData = DB::table('cat_owner')->select('id AS value', 'ownerName AS label')->get();
        $developerData = DB::table('cat_developer')->select('id AS value', 'developerName AS label')->get();
        $builderData = DB::table('cat_builder')->select('id AS value', 'builderName AS label')->get();
        $brokerData = DB::table('cat_broker')->select('id AS value', 'brokerName AS label')->get();
        $listingBrokerData = DB::table('cat_listingbroker')->select('id AS value', 'ListingBrokerName AS label')->get();
        $currencyData = DB::table('cat_currency')->select('id AS value', 'currencyName AS label')->get();
        $tenancyData = DB::table('cat_tenancy')->select('id AS value', 'tenancyName AS label')->get();
        $dealData = DB::table('cat_deal')->select('id AS value', 'dealName AS label')->get();
        $typeData = DB::table('cat_type')->select('id AS value', 'typeName AS label')->get();
        $loadingDoorData = DB::table('cat_loadingdoor')->select('id AS value', 'LoadingDoorName AS label')->get();
        
        $mainReturn['statesData'] = $statesData;
        $mainReturn['classData'] = $classData;
        $mainReturn['statusData'] = $statusData;
        $mainReturn['regionData'] = $regionData;
        $mainReturn['marketData'] = $marketData;

        $mainReturn['ownerData'] = $ownerData;
        $mainReturn['developerData'] = $developerData;
        $mainReturn['builderData'] = $builderData;
        $mainReturn['brokerData'] = $brokerData;
        $mainReturn['listingBrokerData'] = $listingBrokerData;
        $mainReturn['currencyData'] = $currencyData;
        $mainReturn['tenancyData'] = $tenancyData;
        $mainReturn['dealData'] = $dealData;
        $mainReturn['typeData'] = $typeData;

        $mainReturn['loadingDoorData'] = $loadingDoorData;

        // * En caso de que sea un nuevo registro, se retorna el array con los catálogos
        if ($buildingId == 0) {
            return response()->json([
                'mainReturn' => $mainReturn
            ]);
        }

        $building = Buildings::with([
            'buildingAvailable',
            'buildingAbsorption',
            'buildingContacts',
            'buildingFeatures',
            'buildingImages'
        ])->find($buildingId);

        if (!$building) {
            return response()->json(['message' => 'Building not found'], 404);
        }
        
        // * Preparando catálogos seleccionados 
        // * Building State
        if ($mainReturn['statesData']->contains('value', $building->builder_state_id)) {
            $index = $mainReturn['statesData']->search(function($item) use ($building) {
                return $item->value === $building->builder_state_id;
            });

            $mainReturn['statesData'][$index]->selected = "true";
        }

        // * Class
        if ($mainReturn['classData']->contains('value', $building->class_id)) {
            $index = $mainReturn['classData']->search(function($item) use ($building) {
                return $item->value === $building->class_id;
            });

            $mainReturn['classData'][$index]->selected = "true";
        }

        // * statusData
        if ($mainReturn['statusData']->contains('value', $building->status_id)) {
            $index = $mainReturn['statusData']->search(function($item) use ($building) {
                return $item->value === $building->status_id;
            });

            $mainReturn['statusData'][$index]->selected = "true";
        }

        // * regionData
        if ($mainReturn['regionData']->contains('value', $building->status_id)) {
            $index = $mainReturn['regionData']->search(function($item) use ($building) {
                return $item->value === $building->region_id;
            });

            $mainReturn['regionData'][$index]->selected = "true";
        }

        // * Market->SubMarket->IndustrialPark
        if ($mainReturn['marketData']->contains('value', $building->market_id)) {
            $indexMarket = $mainReturn['marketData']->search(function($item) use ($building) {
                return $item->value === $building->market_id;
            });

            $mainReturn['marketData'][$indexMarket]->selected = "true";

            if ($mainReturn['marketData'][$indexMarket]['subMarkets']->contains('value', $building->sub_market_id)) {
                $indexSubMarket = $mainReturn['marketData'][$indexMarket]['subMarkets']->search(function($item) use ($building) {
                    return $item->value === $building->sub_market_id;
                });

                $mainReturn['marketData'][$indexMarket]['subMarkets'][$indexSubMarket]->selected = "true";

                if ($mainReturn['marketData'][$indexMarket]['subMarkets'][$indexSubMarket]['industrialParks']->contains('value', $building->industrial_park_id)) {
                    $indexIndustrialPark = $mainReturn['marketData'][$indexMarket]['subMarkets'][$indexSubMarket]['industrialParks']->search(function($item) use ($building) {
                        return $item->value === $building->industrial_park_id;
                    });

                    $mainReturn['marketData'][$indexMarket]['subMarkets'][$indexSubMarket]['industrialParks'][$indexIndustrialPark]->selected = "true";
                }
            }
        }
        
        // * Owners
        if ($mainReturn['ownerData']->contains('value', $building->owner_id)) {
            $index = $mainReturn['ownerData']->search(function($item) use ($building) {
                return $item->value === $building->owner_id;
            });

            $mainReturn['ownerData'][$index]->selected = "true";
        }
        
        // * Developers
        if ($mainReturn['developerData']->contains('value', $building->developer_id)) {
            $index = $mainReturn['developerData']->search(function($item) use ($building) {
                return $item->value === $building->developer_id;
            });

            $mainReturn['developerData'][$index]->selected = "true";
        }
        
        // * Builder
        if ($mainReturn['builderData']->contains('value', $building->builder_id)) {
            $index = $mainReturn['builderData']->search(function($item) use ($building) {
                return $item->value === $building->builder_id;
            });

            $mainReturn['builderData'][$index]->selected = "true";
        }
        
        // * Broker
        if ($mainReturn['brokerData']->contains('value', $building->broker_id)) {
            $index = $mainReturn['brokerData']->search(function($item) use ($building) {
                return $item->value === $building->broker_id;
            });

            $mainReturn['brokerData'][$index]->selected = "true";
        }
        
        // * Currency
        if ($mainReturn['currencyData']->contains('value', $building->currency_id)) {
            $index = $mainReturn['currencyData']->search(function($item) use ($building) {
                return $item->value === $building->currency_id;
            });

            $mainReturn['currencyData'][$index]->selected = "true";
        }
        
        // * Tenancy
        if ($mainReturn['tenancyData']->contains('value', $building->tenancy_id)) {
            $index = $mainReturn['tenancyData']->search(function($item) use ($building) {
                return $item->value === $building->tenancy_id;
            });

            $mainReturn['tenancyData'][$index]->selected = "true";
        }
        
        // * Deal
        if ($mainReturn['dealData']->contains('value', $building->deal_id)) {
            $index = $mainReturn['dealData']->search(function($item) use ($building) {
                return $item->value === $building->deal_id;
            });

            $mainReturn['dealData'][$index]->selected = "true";
        }
        
        // * Type
        if ($mainReturn['typeData']->contains('value', $building->type_id)) {
            $index = $mainReturn['typeData']->search(function($item) use ($building) {
                return $item->value === $building->type_id;
            });

            $mainReturn['typeData'][$index]->selected = "true";
        }

        // * Preparar los datos en el formato que espera el frontend
        $buildingData = [
            'buildingName' => $building->building_name,
            'smSf' => $building->sf_sm == 0 ? false : true,
            'buildingSizeSf' => $building->sf_sm == 0 ? $building->building_size_sf : $building->building_size_sf / 10.764,
            'expansionLand' => $building->expansion_land,
            'salePriceUsd' => $building->sale_price_usd,
            'latitud' => $building->latitud,
            'longitud' => $building->longitud,
            'yearBuilt' => $building->year_built,
            'clearHeight' => $building->clear_height,
            'officesSpace' => $building->offices_space,
            'crane' => (bool)$building->crane == 0 ? false : true,
            'hvac' => (bool)$building->hvac == 0 ? false : true,
            'railSpur' => (bool)$building->rail_spur == 0 ? false : true,
            'sprinklers' => (bool)$building->sprinklers == 0 ? false : true,
            'office' => (bool)$building->office == 0 ? false : true,
            'leed' => (bool)$building->leed == 0 ? false : true,
            'totalLand' => $building->total_land,
            'hvacProductionArea' => $building->hvac_production_area,
        ];

        // Datos de contacto
        $contactData = [];
        if ($building->buildingContacts) {
            $contactData = [
                'contact' => $building->buildingContacts->contact_name,
                'phone' => $building->buildingContacts->contact_phone,
                'email' => $building->buildingContacts->contact_email,
                'comments' => $building->buildingContacts->contact_comments,
            ];
        }

        // Características del edificio
        if ($building->buildingFeatures) {
            $features = $building->buildingFeatures;
            $buildingData['loadingDoorId'] = $features->loading_door_id;
            $buildingData['lighting'] = $features->lighting;
            $buildingData['ventilation'] = $features->ventilation;
            $buildingData['transformerCapacity'] = $features->transformer_capacity;
            $buildingData['constructionType'] = $features->construction_type;
            $buildingData['constructionState'] = $features->construction_state;
            $buildingData['roofSystem'] = $features->roof_system;
            $buildingData['fireProtectionSystem'] = $features->fire_protection_system;
            $buildingData['skylightsSf'] = $features->skylights_sf;
            $buildingData['coverage'] = $features->coverage;
        }

        // Datos específicos según el estado del edificio
        if ($building->builder_state_id == 1 && $building->buildingAvailable) {
            // Datos de disponibilidad
            $available = $building->buildingAvailable;
            $buildingData['availableSf'] = $building->sf_sm == 0 ? $available->available_sf : $available->available_sf / 10.764;
            $buildingData['minimumSpaceSf'] = $building->sf_sm == 0 ? $available->minimum_space_sf : $available->minimum_space_sf / 10.764;
            $buildingData['expansionUpToSf'] = $building->sf_sm == 0 ? $available->expansion_up_to_sf : $available->expansion_up_to_sf / 10.764;
            $buildingData['dockDoors'] = $available->dock_doors;
            $buildingData['driveInDoor'] = $available->drive_in_door;
            $buildingData['floorThickness'] = $available->floor_thickness;
            $buildingData['floorResistance'] = $available->floor_resistance;
            $buildingData['truckCourt'] = $available->truck_court;
            $buildingData['crossdock'] = (bool)$available->crossdock;
            $buildingData['sharedTruck'] = (bool)$available->shared_truck;
            $buildingData['buildingDimensions1'] = $available->building_dimensions_1;
            $buildingData['buildingDimensions2'] = $available->building_dimensions_2;
            $buildingData['baySize1'] = $available->bay_Size_1;
            $buildingData['baySize2'] = $available->bay_Size_2;
            $buildingData['columnsSpacing1'] = $available->columns_spacing_1;
            $buildingData['columnsSpacing2'] = $available->columns_spacing_2;
            $buildingData['knockoutsDocks'] = $available->knockouts_docks;
            $buildingData['parkingSpace'] = $available->parking_space;
            $buildingData['availableMonth'] = date('Y-m', strtotime("2024-{$available->available_month}-01"));
            $buildingData['availableYear'] = $available->available_year;
            $buildingData['minLease'] = $available->min_lease;
            $buildingData['maxLease'] = $available->max_lease;

        } elseif ($building->builder_state_id == 2 && $building->buildingAbsorption) {
            // Datos de absorción
            $absorption = $building->buildingAbsorption;
            $buildingData['leaseTermMonth'] = $absorption->lease_term_month;
            $buildingData['askingRateShell'] = $absorption->asking_rate_shell;
            $buildingData['closingRate'] = $absorption->closing_rate;
            $buildingData['KVAS'] = $absorption->KVAS;
            $buildingData['closingQuarter'] = $absorption->closing_quarter;
            $buildingData['leaseUp'] = $absorption->lease_up;
            $buildingData['month'] = $absorption->month;
            $buildingData['newConstruction'] = $absorption->new_construction;
            $buildingData['startingConstruction'] = $absorption->starting_construction;
            $buildingData['tenantId'] = $absorption->tenant_id;
            $buildingData['industryId'] = $absorption->industry_id;
            $buildingData['finalUseId'] = $absorption->final_use_id;
            $buildingData['shelterId'] = $absorption->shelter_id;
            $buildingData['copanyTypeId'] = $absorption->copany_type_id;
        }

        // Imágenes del edificio
        $images = $building->buildingImages->map(function($image) {
            return [
                'id' => $image->id,
                'imageTypeId' => $image->imageTypeId,
                'image' => $image->Image
            ];
        });

        return response()->json([
            'mainReturn' => $mainReturn,
            'buildingData' => $buildingData,
            'contactData' => $contactData,
            'images' => $images
        ]);
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
}
