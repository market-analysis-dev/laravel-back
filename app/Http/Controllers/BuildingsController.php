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
// use Google\Service\Directory\Building;
use Illuminate\Support\Facades\DB;

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
    
    public function insertBuilding(Request $request)
    {
        // * Tabla 'buildings'
        
        $builderStateId = $request->builderStateId;
        $buildingName = $request->buildingName;
        $classId = $request->classId;
        $buildingSizeSf = $request->buildingSizeSf;
        $expansionLand = $request->expansionLand;
        $statusId = $request->statusId;
        $industrialParkId = $request->industrialParkId;
        $typeId = $request->typeId;
        $ownerId = $request->ownerId;
        $developerId = $request->developerId;
        $builderId = $request->builderId;
        $regionId = $request->regionId;
        $marketId = $request->marketId;
        $subMarketId = $request->subMarketId;
        $dealId = $request->dealId;
        $currencyId = $request->currencyId;
        $salePriceUsd = $request->salePriceUsd;
        $tenancyId = $request->tenancyId;
        $latitud = $request->latitud;
        $longitud = $request->longitud;
        $yearBuilt = $request->yearBuilt;
        $officesSpace = $request->officesSpace;
        $clearHeight = $request->clearHeight;
        $crane = $request->crane;
        $hvac = $request->hvac;
        $railSpur = $request->railSpur;
        $sprinklers = $request->sprinklers;
        $office = $request->office;
        $leed = $request->leed;
        $totalLand = $request->totalLand;
        $hvacProductionArea = $request->hvacProductionArea;

        $building = BuildingsAvailable::create([
            
        ]);

        if ($building) {

            // * Id del building
            $buildingId = $building->id;

            // * Agregando Contactos a la BD
            $contactName = $request->contactName;
            $contactPhone = $request->contactPhone;
            $contactEmail = $request->contactEmail;
            $contactComments = $request->contactComments;

            BuildingsContacts::insert([
                'building_id' => $buildingId,
                'contact_name' => $contactName,
                'contact_phone' => $contactPhone,
                'contact_email' => $contactEmail,
                'contact_comments' => $contactComments,
            ]);

            // * Insertando buildings Features
            $loadingDoorId = $request->loadingDoorId;
            $lighting = $request->lighting;
            $ventilation = $request->ventilation;
            $transformerCapacity = $request->transformerCapacity;
            $constructionType = $request->constructionType;
            $constructionState = $request->constructionState;
            $roofSystem = $request->roofSystem;
            $fireProtectionSystem = $request->fireProtectionSystem;
            $skylightsSf = $request->skylightsSf;
            $coverage = $request->coverage;

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
            $availableSf = $request->availableSf;
            $minimumSpaceSf = $request->minimumSpaceSf;
            $expansionUpToSf = $request->expansionUpToSf;
            $dockDoors = $request->dockDoors;
            $driveInDoor = $request->driveInDoor;
            $floorThickness = $request->floorThickness;
            $floorResistance = $request->floorResistance;
            $truckCourt = $request->truckCourt;
            $crossdock = $request->crossdock;
            $sharedTruck = $request->sharedTruck;
            $buildingDimensions1 = $request->buildingDimensions1;
            $buildingDimensions2 = $request->buildingDimensions2;
            $baySize1 = $request->baySize1;
            $baySize2 = $request->baySize2;
            $columnsSpacing1 = $request->columnsSpacing1;
            $columnsSpacing2 = $request->columnsSpacing2;
            $knockoutsDocks = $request->knockoutsDocks;
            $parkingSpace = $request->parkingSpace;
            $availableMonth = $request->availableMonth;
            $availableYear = $request->availableYear;
            $minLease = $request->minLease;
            $maxLease = $request->maxLease;

            // * Buildings Absorption
            $leaseTermMonth = $request->leaseTermMonth;
            $askingRateShell = $request->askingRateShell;
            $closingRate = $request->closingRate;
            $KVAS = $request->KVAS;
            $closingQuarter = $request->closingQuarter;
            $leaseUp = $request->leaseUp;
            $month = $request->month;
            $newConstruction = $request->newConstruction;
            $startingConstruction = $request->startingConstruction;
            $tenantId = $request->tenantId;
            $industryId = $request->industryId;
            $finalUseId = $request->finalUseId;
            $shelterId = $request->shelterId;
            $copanyTypeId = $request->copanyTypeId;

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


        exit;        
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
