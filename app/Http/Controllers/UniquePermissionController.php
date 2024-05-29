<?php

namespace App\Http\Controllers;

use App\Models\UniquePermission;
use Illuminate\Http\Request;

class UniquePermissionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = UniquePermission::where('status', 'Activo')->get();
        return response()->json($permission);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'moduleId' => 'required|exists:modules,id',
            'excelPermission' => 'required|boolean',
            'fibrasPermission' => 'required|boolean',
            'biChartsPermission' => 'required|boolean',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return UniquePermission::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $permission = UniquePermission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        return response()->json($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'moduleId' => 'required|exists:modules,id',
            'excelPermission' => 'required|boolean',
            'fibrasPermission' => 'required|boolean',
            'biChartsPermission' => 'required|boolean',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $permission = UniquePermission::findOrFail($id);
        $permission->update($request->all());

        return response()->json($permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permission = UniquePermission::findOrFail($id);

        $permission->status = 'Inactivo';
        $permission->save();

        return response()->json(['message' => 'Permiso eliminado correctamente']);
    }
}
