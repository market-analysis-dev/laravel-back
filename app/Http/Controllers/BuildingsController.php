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

            default:
                return response()->json(['message' => 'Table Name Error']);
            break;
            
        }

        // * INSERT del nuevo registro
        DB::table($tableName)->insert([
            $columnName => $nameRegister,
        ]);
        
    }

    public function SubMarketByMarket(Request $request)
    {
        $marketId = $request->marketId;

        $subMarkets = SubMarket::select('id as value', 'subMarketName as label')
            ->where('marketId', $marketId)
            ->where('status', 'Activo')
            ->get();

        return response()->json($subMarkets);
    }

    public function getIndustrialParks(Request $request)
    {
        $marketId = $request->marketId;
        $subMarketId = $request->subMarketId;

        if ($subMarketId == "") {

            $industrialParks = IndustrialParks::select('id as value', 'industrialParkName as label')
                ->where('marketId', $marketId)
                ->get();

        } else {

            $industrialParks = IndustrialParks::select('id as value', 'industrialParkName as label')
                ->where('marketId', $marketId)
                ->where('subMarketId', $subMarketId)
                ->get();
        }

        return response()->json($industrialParks);
    }

    public function testing(Request $request)
    {
        // Obtenemos el JSON enviado desde el front-end
        $buildingDataJSON = $request->input('buildingData');

        // Decodificamos el JSON en un array asociativo de PHP
        $buildingData = json_decode($buildingDataJSON, true);

        return response()->json($buildingData);
        exit;

        // Verificamos si hubo algún error en la decodificación
        if (json_last_error() === JSON_ERROR_NONE) {
            // Iteramos sobre el array para manipular los datos

            // echo $buildingData['builderStateId'] . "\n";

            foreach ($buildingData as $key => $value) {
                // Aquí puedes manipular las variables como desees
                // Por ejemplo, podrías guardarlas en la base de datos o imprimirlas
                // echo "Clave: $key, Valor: $value\n";
            }
            
            // Retornamos la respuesta
            // return response()->json($buildingData); // Devuelve los datos manipulados si es necesario
        } else {
            return response()->json(['error' => 'Error al decodificar JSON: ' . json_last_error_msg()], 400);
        }
    }
        
    public function insertBuilding(Request $request)
    {
        $buildingDataJSON = $request->input('buildingData');
        $buildingData = json_decode($buildingDataJSON, true);
        $contactDataJSON = $request->input('contactData');
        $contactData = json_decode($contactDataJSON, true);

        // * Tabla 'buildings'
        $builderStateId = $buildingData['builderStateId'];
        $buildingName = $buildingData['buildingName'];
        $classId = $buildingData['classId'];
        $buildingSizeSf = $buildingData['buildingSizeSf'];
        $expansionLand = $buildingData['expansionLand'];
        $statusId = $buildingData['statusId'];
        // $industrialParkId = $buildingData['industrialParkId'];
        $industrialParkId = 166;
        $typeId = $buildingData['typeId'];
        $ownerId = $buildingData['ownerId'];
        $developerId = $buildingData['developerId'];
        $builderId = $buildingData['builderId'];
        $regionId = $buildingData['regionId'];
        $marketId = $buildingData['marketId'];
        $subMarketId = $buildingData['subMarketId'];
        $dealId = $buildingData['dealId'];
        $currencyId = $buildingData['currencyId'];
        $salePriceUsd = $buildingData['salePriceUsd'];
        $tenancyId = $buildingData['tenancyId'];
        $latitud = $buildingData['latitud'];
        $longitud = $buildingData['longitud'];
        $yearBuilt = $buildingData['yearBuilt'];
        $clearHeight = $buildingData['clearHeight'];
        $officesSpace = $buildingData['officesSpace'];
        $crane = $buildingData['crane'] == true ? 1 : 0;
        $hvac = $buildingData['hvac'] == true ? 1 : 0;
        $railSpur = $buildingData['railSpur'] == true ? 1 : 0;
        $sprinklers = $buildingData['sprinklers'] == true ? 1 : 0;
        $office = $buildingData['office'] == true ? 1 : 0;
        $leed = $buildingData['leed'] == true ? 1 : 0;
        $totalLand = $buildingData['totalLand'];
        $hvacProductionArea = $buildingData['hvacProductionArea'];

        $building = Buildings::create([
            'builder_state_id' => $builderStateId,
            'building_name' => $buildingName,
            'class_id' => $classId,
            'building_size_sf' => $buildingSizeSf,
            'expansion_land' => $expansionLand,
            'status_id' => $statusId,
            'industrial_park_id' => $industrialParkId,
            'type_id' => $typeId,
            'owner_id' => $ownerId,
            'developer_id' => $developerId,
            'builder_id' => $builderId,
            'region_id' => $regionId,
            'market_id' => $marketId,
            'sub_market_id' => $subMarketId,
            'deal_id' => $dealId,
            'currency_id' => $currencyId,
            'sale_price_usd' => $salePriceUsd,
            'tenancy_id' => $tenancyId,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'year_built' => $yearBuilt,
            'clear_height' => $clearHeight,
            'offices_space' => $officesSpace,
            'crane' => $crane,
            'hvac' => $hvac,
            'rail_spur' => $railSpur,
            'sprinklers' => $sprinklers,
            'office' => $office,
            'leed' => $leed,
            'total_land' => $totalLand,
            'hvac_production_area' => $hvacProductionArea,
            'status' => 'Activo'
        ]);

        if ($building) {

            // * Id del building
            $buildingId = $building->id;
            /*
                // * Agregando las imagenes (de la pestaña de imagenes).
                if ($request->hasFile('photoTypes')) {

                    
                    // * 1 => Aerea
                    //  * 2 => Galería
                    //  * 3 => Portada
                    
                    
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
                }

                // * Agregando las imagenes (de la pestañas de extras [imagenes 360]).
                if ($request->hasFile('aroundImages')) {
                    
                    foreach ($request->file('aroundImages') as $file) {
                        
                        $originalName = $file->getClientOriginalName();

                        $imageInsert = BuildingsImages::create([
                            'buildingId' => $buildingId,
                            'imageTypeId' => 0,
                            'Image' => $originalName
                        ]);

                        // * validando que se inserta en la BD...
                        if ($imageInsert) {
                            $imagePath = $file->store('buildingsImages', 'public');
                        }
                    }
                }
            */
            // * Agregando Contactos a la BD
            $contactName = $contactData['contact'];
            $contactPhone = $contactData['phone'];
            $contactEmail = $contactData['email'];
            $contactComments = $contactData['comments'];

            BuildingsContacts::insert([
                'building_id' => $buildingId,
                'contact_name' => $contactName,
                'contact_phone' => $contactPhone,
                'contact_email' => $contactEmail,
                'contact_comments' => $contactComments,
            ]);

            // * Insertando buildings Features
            $loadingDoorId = $buildingData['loadingDoorId'];
            $lighting = $buildingData['lighting'];
            $ventilation = $buildingData['ventilation'];
            $transformerCapacity = $buildingData['transformerCapacity'];
            $constructionType = $buildingData['constructionType'];
            $constructionState = $buildingData['constructionState'];
            $roofSystem = $buildingData['roofSystem'];
            $fireProtectionSystem = $buildingData['fireProtectionSystem'];
            $skylightsSf = $buildingData['skylightsSf'];
            $coverage = $buildingData['coverage'];

            BuildingsFeatures::insert([
                'building_id' => $buildingId,
                'loading_door_id' => $loadingDoorId,
                'lighting' => $lighting,
                'ventilation' => $ventilation,
                'transformer_capacity' => $transformerCapacity,
                'construction_type' => $constructionType,
                'construction_state' => $constructionState,
                'roof_system' => $roofSystem,
                'fire_protection_system' => $fireProtectionSystem,
                'skylights_sf' => $skylightsSf,
                'coverage' => $coverage,
            ]);

            // * Buildings Available
            $availableSf = $buildingData['availableSf'];
            $minimumSpaceSf = $buildingData['minimumSpaceSf'];
            $expansionUpToSf = $buildingData['expansionUpToSf'];
            $dockDoors = $buildingData['dockDoors'];
            $driveInDoor = $buildingData['driveInDoor'];
            $floorThickness = $buildingData['floorThickness'];
            $floorResistance = $buildingData['floorResistance'];
            $truckCourt = $buildingData['truckCourt'];
            $crossdock = $buildingData['crossdock'];
            $sharedTruck = $buildingData['sharedTruck'];
            $buildingDimensions1 = $buildingData['buildingDimensions1'];
            $buildingDimensions2 = $buildingData['buildingDimensions2'];
            $baySize1 = $buildingData['baySize1'];
            $baySize2 = $buildingData['baySize2'];
            $columnsSpacing1 = $buildingData['columnsSpacing1'];
            $columnsSpacing2 = $buildingData['columnsSpacing2'];
            $knockoutsDocks = $buildingData['knockoutsDocks'];
            $parkingSpace = $buildingData['parkingSpace'];
            $arrayAvailableMonth = explode("-", $buildingData['availableMonth']);
            $availableMonth = intval($arrayAvailableMonth[1]);
            $availableYear = $buildingData['availableYear'];
            $minLease = $buildingData['minLease'];
            $maxLease = $buildingData['maxLease'];

            // * Buildings Absorption
            $leaseTermMonth = $buildingData['leaseTermMonth'];
            $askingRateShell = $buildingData['askingRateShell'];
            $closingRate = $buildingData['closingRate'];
            $KVAS = $buildingData['KVAS'];
            $closingQuarter = $buildingData['closingQuarter'];
            $leaseUp = $buildingData['leaseUp'];
            $month = $buildingData['month'];
            $newConstruction = $buildingData['newConstruction'];
            $startingConstruction = $buildingData['startingConstruction'];
            $tenantId = $buildingData['tenantId'];
            $industryId = $buildingData['industryId'];
            $finalUseId = $buildingData['finalUseId'];
            $shelterId = $buildingData['shelterId'];
            $copanyTypeId = $buildingData['copanyTypeId'];

            switch ($builderStateId) {
                case 1: // * Availability
                    
                    BuildingsAvailable::insert([
                        'building_id' => $buildingId,
                        'available_sf' => $availableSf,
                        'minimum_space_sf' => $minimumSpaceSf,
                        'expansion_up_to_sf' => $expansionUpToSf,
                        'dock_doors' => $dockDoors,
                        'drive_in_door' => $driveInDoor,
                        'floor_thickness' => $floorThickness,
                        'floor_resistance' => $floorResistance,
                        'truck_court' => $truckCourt,
                        'crossdock' => $crossdock,
                        'shared_truck' => $sharedTruck,
                        'building_dimensions_1' => $buildingDimensions1,
                        'building_dimensions_2' => $buildingDimensions2,
                        'bay_Size_1' => $baySize1,
                        'bay_Size_2' => $baySize2,
                        'columns_spacing_1' => $columnsSpacing1,
                        'columns_spacing_2' => $columnsSpacing2,
                        'knockouts_docks' => $knockoutsDocks,
                        'parking_space' => $parkingSpace,
                        'available_month' => $availableMonth,
                        'available_year' => $availableYear,
                        'min_lease' => $minLease,
                        'max_lease' => $maxLease
                    ]);
                break;
    
                case 2: // * Absorption

                    BuildingsAbsorption::insert([
                        'lease_term_month' => $leaseTermMonth,
                        'asking_rate_shell' => $askingRateShell,
                        'closing_rate' => $closingRate,
                        'KVAS' => $KVAS,
                        'closing_quarter' => $closingQuarter,
                        'lease_up' => $leaseUp,
                        'month' => $month,
                        'new_construction' => $newConstruction,
                        'starting_construction' => $startingConstruction,
                        'building_id' => $buildingId,
                        'tenant_id' => $tenantId,
                        'industry_id' => $industryId,
                        'final_use_id' => $finalUseId,
                        'shelter_id' => $shelterId,
                        'copany_type_id' => $copanyTypeId,
                    ]);
                break;
            }

        } else {
            return response()->json([
                'title' => 'Error',
                'text' => "It was not possible to add this building",
                'icon' => 'error'
            ]);
        }
    }

    public function getBuildingById($buildingId)
    {
        $building = Buildings::find($buildingId);

        if (!$building) {
            return response()->json(['message' => 'Building not found'], 404);
        }

        $mergeData = [];

        // * Datos tabla "buildings"

        return response()->json($building);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
