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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|integer|exists:users,id',
            'moduleId' => 'required|integer|exists:modules,id',
            'marketId' => 'required|integer|exists:markets,id',
            'subMarketId' => 'required|integer|exists:submarkets,id',
            'year' => 'required|integer',
            'quarter' => 'required|integer',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return Permission::create($request->all());
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
