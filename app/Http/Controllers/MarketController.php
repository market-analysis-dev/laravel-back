<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;

class MarketController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $market = Market::where('status', 'Activo')->get();
        return response()->json($market);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marketName' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return Market::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $market = Market::find($id);

        if (!$market) {
            return response()->json(['message' => 'Market not found'], 404);
        }

        return response()->json($market);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'marketName' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $market = Market::findOrFail($id);
        $market->update($request->all());

        return response()->json($market);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $market = Market::findOrFail($id);

        $market->status = 'Inactivo';
        $market->save();

        return response()->json(['message' => 'Mercado eliminado correctamente']);
    }
}
