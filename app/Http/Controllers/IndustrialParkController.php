<?php

namespace App\Http\Controllers;

use App\Models\IndustrialPark;
use App\Http\Requests\StoreIndustrialParkRequest;
use App\Http\Requests\UpdateIndustrialParkRequest;

class IndustrialParkController extends Controller
{
    public function index()
    {
        return IndustrialPark::all();
    }

    public function store(StoreIndustrialParkRequest $request)
    {
        $industrialPark = IndustrialPark::create($request->validated());
        return response()->json($industrialPark, 201);
    }

    public function update(UpdateIndustrialParkRequest $request, IndustrialPark $industrialPark)
    {
        $industrialPark->update($request->validated());
        return response()->json($industrialPark);
    }

    public function destroy(IndustrialPark $industrialPark)
    {
        $industrialPark->delete();
        return response()->json(null, 204);
    }
}
