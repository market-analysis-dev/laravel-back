<?php

namespace App\Http\Controllers;

use App\Models\ModulesColumn;
use Illuminate\Http\Request;

class ModulesColumnController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cols = ModulesColumn::where('status', 'Activo')->get();
        return response()->json($cols);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'columnName' => 'required|string|max:255',
            'moduleId' => 'required|exists:modules,id',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return ModulesColumn::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cols = ModulesColumn::find($id);

        if (!$cols) {
            return response()->json(['message' => 'Cols not found'], 404);
        }

        return response()->json($cols);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'columnName' => 'required|string|max:255',
            'moduleId' => 'required|exists:modules,id',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $cols = ModulesColumn::findOrFail($id);
        $cols->update($request->all());

        return response()->json($cols);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cols = ModulesColumn::findOrFail($id);

        $cols->status = 'Inactivo';
        $cols->save();

        return response()->json(['message' => 'Columna eliminada correctamente']);
    }
}
