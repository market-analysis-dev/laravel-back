<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Market;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quartersArray = explode(",", $request->quarters);
        $yearsArray = explode(",", $request->years);
        $marketArray = explode(",", $request->markets);
        $subMarketArray = explode(",", $request->submarkets);
        $modulesArray = explode(",", $request->modules);
        $userId = $request->userId;

        // > INSERTANDO PERMISOS DE QUARTERS
        foreach ($quartersArray as $key => $quarters) {
            // * Separando año de quarter
            $splitValue = explode("_", $quarters);
            $yearValue = $splitValue[0];
            $quarterValue = $splitValue[1];

            // * Verificar si el registro ya existe
            $exists = DB::table('userpermissionsquarters')
                ->where('userId', $userId)
                ->where('year', $yearValue)
                ->where('quarter', $quarterValue)
                ->exists();

            if (!$exists) {
                // * Insert de permisos por año y quarters
                DB::table('userpermissionsquarters')->insert([
                    'userId' => $userId,
                    'year' => $yearValue,
                    'quarter' => $quarterValue,
                    'status' => 1
                ]);
            }
        }

        // > INSERTANDO PERMISOS DE AÑOS
        foreach ($yearsArray as $key => $year) {
            // * Verificar si el registro ya existe
            $exists = DB::table('userpermissionsyears')
                ->where('userId', $userId)
                ->where('year', $yearValue)
                ->exists();

            if (!$exists) {
                // * Insert de permisos por año y quarters
                DB::table('userpermissionsyears')->insert([
                    'userId' => $userId,
                    'year' => $yearValue,
                    'status' => 1
                ]);
            }
        }

        // > INSERTANDO PERMISOS DE MERCADOS
        foreach ($marketArray as $key => $market) {
            // * Eliminando "market_" del string
            $marketId = str_replace("market_", "", $market);

            // * Verificar si el registro ya existe
            $exists = DB::table('userpermissionsmarket')
                ->where('userId', $userId)
                ->where('marketId', $marketId)
                ->exists();
            
            if (!$exists) {
                // * Insert de permisos de market
                DB::table('userpermissionsmarket')->insert([
                    'userId' => $userId,
                    'marketId' => $marketId,
                    'status' => 1
                ]);
            }
        }

        // > INSERTANDO PERMISOS DE SUBMERCADOS
        foreach ($subMarketArray as $key => $subMarketId) {

            // * Verificar si el registro ya existe
            $exists = DB::table('userpermissionssubmarket')
                ->where('userId', $userId)
                ->where('subMarketId', $subMarketId)
                ->exists();
            
            if (!$exists) {
                // * Insert de permisos de market
                DB::table('userpermissionssubmarket')->insert([
                    'userId' => $userId,
                    'subMarketId' => $subMarketId,
                    'status' => 1
                ]);
            }
        }

        // > INSERTANDO PERMISOS DE MODULOS
        foreach ($modulesArray as $key => $moduleId) {
            
            // * Verificar si el registro ya existe
            $exists = DB::table('userpermissionsmodule')
                ->where('userId', $userId)
                ->where('moduleId', $moduleId)
                ->exists();
            
            if (!$exists) {
                DB::table('userpermissionsmodule')->insert([
                    'userId' => $userId,
                    'moduleId' => $moduleId,
                    'status' => 1
                ]);
            }
        }

        return response()->json(['message' => 'Permissions added successfully!']);
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
        $permissionsYears = DB::table('UserPermissionsYears')->where('userId', $id)->get();
        $permissionsQuarters = DB::table('UserPermissionsQuarters')->where('userId', $id)->get();

        // Verificar si no se encontraron permisos en ninguna tabla
        if ($permissionsModule->isEmpty() && $permissionsMarket->isEmpty() && 
            $permissionsSubmarket->isEmpty() && $permissionsYears->isEmpty() && 
            $permissionsQuarters->isEmpty()) {
            return response()->json(['message' => 'Permissions not found'], 404);
        }

        // Construir la respuesta con los permisos de cada tabla
        $permissions = [
            'module' => $permissionsModule,
            'market' => $permissionsMarket,
            'submarket' => $permissionsSubmarket,
            'years' => $permissionsYears,
            'quarters' => $permissionsQuarters,
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
