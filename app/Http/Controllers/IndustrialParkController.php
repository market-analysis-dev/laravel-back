<?php

namespace App\Http\Controllers;

use App\Models\IndustrialPark;
use Illuminate\Http\Request;

class IndustrialParkController
{
    public function index()
    {
        return response()->json(IndustrialPark::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            // 'market_id' => 'nullable|integer|exist:markets,id',
            // 'sub_market_id' => 'nullable|integer|exist:sub_markets,id',
            'market_id' => 'nullable|integer',
            'sub_market_id' => 'nullable|integer',
        ]);

        // $data['created_by'] = auth()->id();
        $data['created_by'] = 1;
        $industrialPark = IndustrialPark::create($data);

        return response()->json($industrialPark, 201);
    }

    public function update(Request $request, $id)
    {
        $industrialPark = IndustrialPark::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            // 'market_id' => 'nullable|integer|exist:markets,id',
            // 'sub_market_id' => 'nullable|integer|exist:sub_markets,id',
            'market_id' => 'nullable|integer',
            'sub_market_id' => 'nullable|integer',
        ]);

        // $data['updated_by'] = auth()->id();
        $data['updated_by'] = 1;
        $industrialPark->update($data);

        return response()->json($industrialPark);

    }

    public function destroy($id)
    {
        $industrialPark = IndustrialPark::findOrFail($id);
        $industrialPark->delete();

        return response()->json(null, 204);
    }
}
