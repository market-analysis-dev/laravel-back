<?php

namespace App\Http\Controllers;

use App\Models\SubMarket;
use Illuminate\Http\Request;

class SubMarketController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submarket = SubMarket::where('status', 'Activo')->get();
        return response()->json($submarket);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subMarketName' => 'required|string|max:255',
            'marketId' => 'required|integer|exists:markets,id',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return SubMarket::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $submarket = SubMarket::find($id);

        if (!$submarket) {
            return response()->json(['message' => 'SubMarket not found'], 404);
        }

        return response()->json($submarket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subMarketName' => 'sometimes|required|string|max:255',
            'marketId' => 'sometimes|required|integer|exists:markets,id',
            'status' => 'sometimes|required|in:Activo,Inactivo',
        ]);

        $submarket = SubMarket::findOrFail($id);
        $submarket->update($request->all());

        return response()->json($submarket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $submarket = SubMarket::findOrFail($id);

        $submarket->status = 'Inactivo';
        $submarket->save();

        return response()->json(['message' => 'Submercado eliminado correctamente']);
    }
}
