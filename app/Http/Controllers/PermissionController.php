<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /*
     * MULTIPLE INSERT
     */
    public function store(Request $request)
    {
        $userId = $request->userId;

        /*
         * Permisos Únicos
         */

        $excelPermission = $request->excelPermission == true ? 1 : 0;
        $flyerPermission = $request->flyerPermission == true ? 1 : 0;
        $columnsPermission = $request->columnsPermission == true ? 1 : 0;
        $fibrasPermission = $request->fibrasPermission == true ? 1 : 0;

        $arrayName = [
            "1" => $excelPermission, // * excel
            "2" => $flyerPermission, // * flyer
            "3" => $columnsPermission, // * columnas
            "4" => $fibrasPermission // * columnas
        ];

        foreach ($arrayName as $key => $permission) {

            $exists = DB::table('permissions_unique')
                    ->where('userId', $userId)
                    ->where('permissionId', $key)
                    ->exists();

            if (!$exists && $permission == 1) {
                DB::table('permissions_unique')->insert([
                    'userId' => $userId,
                    'permissionId' => $key,
                    'status' => 1
                ]);
            }
        }

        /*
         * Permisos BiCharts
         */
        $biChartsPermission = explode(",", $request->biChartsPermission);

        foreach ($biChartsPermission as $key => $module) {

            $exists = DB::table('permissions_submodules')
                    ->where('userId', $userId)
                    ->where('subModuleId', $module)
                    ->exists();

            if (!$exists) {
                DB::table('permissions_submodules')->insert([
                    'userId' => $userId,
                    'subModuleId' => $module,
                    'status' => 1
                ]);
            }
        }

        /*
         * Permisos
         */
        $modulesArray = explode(",", $request->modulesCbo);
        // $marketArray = $request->marketsArray;
        $marketArray = json_decode($request->marketsArray, true);
        $yearsArray = explode(",", $request->yearsCbo);
        $quartersArray = explode(",", $request->quartersCbo);

        
        foreach ($modulesArray as $key => $moduleId) {
            
            foreach ($marketArray as $key => $market) {
                $marketId = str_replace("market_", "", $market["marketId"]);
                $submarketId = $market["subMarketId"];

                switch ($moduleId) {
                    case 1:
                    case 5:
                    case 7:
                    case 10:
                    case 14:

                        $exists = DB::table('permissions')
                                ->where('userId', $userId)
                                ->where('moduleId', $moduleId)
                                ->where('marketId', $marketId)
                                ->where('subMarketId', $submarketId)
                                ->exists();

                        if (!$exists) {
                            // echo "userId => $userId, moduleId => $moduleId, marketId => $marketId, subMarketId => $submarketId, year => NULL, quarter => NULL, status => 1 \n";
                            DB::table('permissions')->insert([
                                'userId' => $userId,
                                'moduleId' => $moduleId,
                                'marketId' => $marketId,
                                'subMarketId' => $submarketId,
                                'year' => NULL,
                                'quarter' => NULL,
                                'status' => 'Activo'
                            ]);
                        }
                    break;
                    
                    default:

                        foreach ($yearsArray as $key => $year) {
                            foreach ($quartersArray as $key => $quarter) {

                                $exists = DB::table('permissions')
                                        ->where('userId', $userId)
                                        ->where('moduleId', $moduleId)
                                        ->where('marketId', $marketId)
                                        ->where('subMarketId', $submarketId)
                                        ->where('year', $year)
                                        ->where('quarter', $quarter)
                                        ->exists();

                                if (!$exists) {
                                    // echo "userId => $userId, moduleId => $moduleId, marketId => $marketId, subMarketId => $submarketId, year => $year, quarter => $quarter, status => 1 \n";
                                    DB::table('permissions')->insert([
                                        'userId' => $userId,
                                        'moduleId' => $moduleId,
                                        'marketId' => $marketId,
                                        'subMarketId' => $submarketId,
                                        'year' => $year,
                                        'quarter' => $quarter,
                                        'status' => 'Activo'
                                    ]);
                                }
                            }
                        }
                    break;
                }
            }
        }

        return response()->json(['message' => 'Permissions added successfully!']);
    }

    /*
     * SHOW INDIVIDUAL PERMISSIONS
     */

    public function showPermissions(Request $request){

        $userId = $request->userId;
        $moduleId = $request->moduleId;
        $year = $request->year;
        $quarter = $request->quarter;

        $mainReturn = [];
        $cleanArray = [];

        switch ($moduleId) {
            case 1:
            case 5:
            case 7:
            case 10:
            case 14:

                $newArray = [];

                $marketsArray = DB::table('permissions')
                    ->join('markets', 'permissions.marketId',  '=', 'markets.id')
                    ->select(
                        DB::raw('CONCAT("market_", permissions.marketId) AS value'),
                        'markets.marketName AS label'
                    )
                    ->where('permissions.moduleId', $moduleId)
                    ->where('permissions.userId', $userId)
                    ->distinct()
                    ->get();

                foreach ($marketsArray as $key => $marketValue) {

                    $cleanArray = array(
                        'value' => $marketValue->value,
                        'label' => $marketValue->label,
                        'options' => []
                    );

                    $marketId = str_replace("market_", "", $marketValue->value);

                    // * agrupando los submercados a los mercados
                    // $mainReturn['markets'][$key]['options'] = DB::table('permissions')
                    $submarket = DB::table('permissions')
                        ->join('submarkets', 'permissions.subMarketId',  '=', 'submarkets.id')
                        ->select('permissions.subMarketId AS value', 'submarkets.subMarketName AS label')
                        ->where('permissions.moduleId', $moduleId)
                        ->where('permissions.marketId', $marketId)
                        ->where('permissions.userId', $userId)
                        ->get();

                    foreach ($submarket as $key => $subMarketId) {
                        
                        $arrayOptions = array(
                            "value" => $subMarketId->value,
                            "label" => $subMarketId->label,
                            "selected" => true
                        );

                        array_push($cleanArray['options'], $arrayOptions);
                    }

                    array_push($newArray, $cleanArray);
                }

                $mainReturn['markets'] = $newArray;

            break;
            
            default:

                // * en caso de no recibir un año válido se sale de la función
                if ($year == 0 || $year == "") {
                    return;
                }

                // * en caso de no recibir un quarter válido se sale de la función
                if ($quarter == "") {
                    return;
                }

                $newArray = [];

                $marketsArray = DB::table('permissions')
                    ->join('markets', 'permissions.marketId',  '=', 'markets.id')
                    ->select(
                        DB::raw('CONCAT("market_", permissions.marketId) AS value'),
                        'markets.marketName AS label'
                    )
                    ->where('permissions.moduleId', $moduleId)
                    ->where('permissions.userId', $userId)
                    ->where('permissions.year', $year)
                    ->where('permissions.quarter', $quarter)
                    ->distinct()
                    ->get();

                foreach ($marketsArray as $key => $marketValue) {

                    $cleanArray = array(
                        'value' => $marketValue->value,
                        'label' => $marketValue->label,
                        'options' => []
                    );

                    $marketId = str_replace("market_", "", $marketValue->value);

                    // * agrupando los submercados a los mercados
                    // $mainReturn['markets'][$key]['options'] = DB::table('permissions')
                    $submarket = DB::table('permissions')
                        ->join('submarkets', 'permissions.subMarketId',  '=', 'submarkets.id')
                        ->select('permissions.subMarketId AS value', 'submarkets.subMarketName AS label')
                        ->where('permissions.moduleId', $moduleId)
                        ->where('permissions.marketId', $marketId)
                        ->where('permissions.userId', $userId)
                        ->where('permissions.year', $year)
                        ->where('permissions.quarter', $quarter)
                        ->distinct()
                        ->get();

                    foreach ($submarket as $key => $subMarketId) {
                        
                        $arrayOptions = array(
                            "value" => $subMarketId->value,
                            "label" => $subMarketId->label,
                            "selected" => true
                        );

                        array_push($cleanArray['options'], $arrayOptions);
                    }

                    array_push($newArray, $cleanArray);
                }

                $mainReturn['markets'] = $newArray;

            break;
        }

        return response()->json($mainReturn);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // * Buscar permisos en cada tabla
        $permissionsModule = DB::table('UserPermissionsModule')->where('userId', $id)->get();
        $permissionsMarket = DB::table('UserPermissionsMarket')->where('userId', $id)->get();
        $permissionsSubmarket = DB::table('UserPermissionsSubmarket')->where('userId', $id)->get();
        $permissionsQuarters = DB::table('UserPermissionsQuarters')
            ->where('userId', $id)
            // ->select('id', 'userId', 'year', 'quarter', 'status')
            ->select('userId', 'year', 'quarter', 'status')
            ->orderBy('year', 'asc')
            ->get();
        // // $permissionsYears = DB::table('UserPermissionsYears')->where('userId', $id)->get();

        // * Verificar si no se encontraron permisos en ninguna tabla
        if ($permissionsModule->isEmpty() && $permissionsMarket->isEmpty() && $permissionsSubmarket->isEmpty() && $permissionsQuarters->isEmpty()) {
            return response()->json(['message' => 'Permissions not found'], 404);
        }
        
        // * Organizar los permisos por año y quarters
        $organizedPermissions = [];

        foreach ($permissionsQuarters as $permission) {

            $year = $permission->year;

            if (!isset($organizedPermissions[$year])) {
                $organizedPermissions[$year] = [
                    // 'id' => $permission->id,
                    'userId' => $permission->userId,
                    'year' => $year,
                    'status' => $permission->status,
                    'quarters' => []
                ];
            }

            $organizedPermissions[$year]['quarters'][] = $permission->quarter;
        }

        // * Convertir la estructura asociativa en un array indexado
        $quartersArraySort = array_values($organizedPermissions);

        // * Construir la respuesta con los permisos de cada tabla
        $permissions = [
            'module' => $permissionsModule,
            'market' => $permissionsMarket,
            'submarket' => $permissionsSubmarket,
            'years' => $quartersArraySort,
        ];

        return response()->json($permissions);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'moduleId' => 'required|exists:modules,id',
            'marketId' => 'required|exists:markets,id',
            'subMarketId' => 'required|exists:sub_markets,id',
            'year' => 'required|integer',
            'quarter' => 'required|integer',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $permissions = Permission::findOrFail($id);
        $permissions->update($request->all());

        return response()->json($permissions);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permissions = Permission::findOrFail($id);

        $permissions->status = 'Inactivo';
        $permissions->save();

        return response()->json(['message' => 'Permiso eliminado correctamente']);
    }
}
