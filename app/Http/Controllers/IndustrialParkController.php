<?php

namespace App\Http\Controllers;

use App\Models\IndustrialPark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustrialParkController extends Controller
{
    public function index()
    {
        return response()->json(IndustrialPark::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'market_id' => 'nullable|exists:cat_markets,id',
            'sub_market_id' => 'nullable|exists:cat_sub_markets,id',
        ]);

        // * Create
        $industrialPark = IndustrialPark::create([
            'name' => $request->name,
            'market_id' => $request->market_id,
            'sub_market_id' => $request->sub_market_id,
            'created_by' => Auth::id(), // Asignar el ID del usuario logueado
            'updated_by' => Auth::id(), // Asignar el ID del usuario logueado
        ]);

        return response()->json($industrialPark, 201);
    }

    public function update(Request $request, $id)
    {
        $industrialPark = IndustrialPark::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'market_id' => 'nullable|exists:cat_markets,id',
            'sub_market_id' => 'nullable|exists:cat_sub_markets,id',
        ]);

        $industrialPark->update([
            'name' => $request->name,
            'market_id' => $request->market_id,
            'sub_market_id' => $request->sub_market_id,
            'updated_by' => Auth::id(),
        ]);

        return response()->json($industrialPark);
    }

    public function destroy($id)
    {
        $industrialPark = IndustrialPark::findOrFail($id);
        $industrialPark->delete();

        return response()->json(null, 204);
    }
}
