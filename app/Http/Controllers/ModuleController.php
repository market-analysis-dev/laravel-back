<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::where('Status', 'Activo')->get();
        return response()->json($modules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'moduleName' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $module = Module::create($request->all());

        return response()->json($module, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $module = Module::find($id);

        if (!$module) {
            return response()->json(['message' => 'Market not found'], 404);
        }

        return response()->json($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'moduleName' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $module = Module::findOrFail($id);
        $module->update($request->all());

        return response()->json($module);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module = Module::findOrFail($id);

        $module->status = 'Inactivo';
        $module->save();

        return response()->json(['message' => 'Modulo eliminado correctamente']);
    }
}
