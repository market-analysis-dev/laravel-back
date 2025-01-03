<?php

namespace App\Http\Controllers;

use App\Models\IndustrialPark;
use App\Http\Requests\StoreIndustrialParkRequest;
use App\Http\Requests\UpdateIndustrialParkRequest;

class IndustrialParkController extends ApiController
{
    public function index()
    {
        return IndustrialPark::all();
    }

    public function store(StoreIndustrialParkRequest $request): \App\Responses\ApiResponse
    {
        try {
            $industrialPark = IndustrialPark::create($request->validated());
            return $this->success('Industrial Park created successfully', $industrialPark);
            
        } catch (\Exception $e) {
            return $this->error('Error creating industrial park: ' . $e->getMessage(), 500);
        }
    }

    public function update(UpdateIndustrialParkRequest $request, IndustrialPark $industrialPark): \Illuminate\Http\JsonResponse
    {
        $industrialPark->update($request->validated());
        return response()->json($industrialPark);
    }

    public function destroy(IndustrialPark $industrialPark): \App\Responses\ApiResponse
    {
        try {
            
            if ($industrialPark->delete()) {
                return $this->success('Industrial Park deleted successfully');
            }

            return response()->json(null, 204);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }        
    }
}
