<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\SubMarket;
use Google\Service\Directory\Building;
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

    public function insertBuilding(Request $request)
    {
        // $building = new Building();
        echo "User Clones String: " . $request->userClones . "\n";
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
