<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustrialParkRequest;
use App\Http\Requests\UpdateIndustrialParkRequest;
use App\Models\IndustrialPark;
use Illuminate\Http\Request;

class IndustrialParkController extends ApiController
{
    public function index(Request $request): \App\Responses\ApiResponse
    {
        $query = IndustrialPark::query();

        if ($request->has('market_id')) {
            $query->where('market_id', $request->input('market_id'));
        }

        if ($request->has('submarket_id')) {
            $query->where('submarket_id', $request->input('submarket_id'));
        }

        $industrialParks = $query->get();

        return $this->success(data: $industrialParks);
    }

    public function store(StoreIndustrialParkRequest $request): \App\Responses\ApiResponse
    {
        try {
            $industrialPark = IndustrialPark::create($request->validated());
            return $this->success('Industrial Park created successfully', $industrialPark);

        } catch (\Exception $e) {
            return $this->error('Error creating industrial park: ' . $e->getMessage(), status: 500);
        }
    }

    public function update(UpdateIndustrialParkRequest $request, IndustrialPark $industrialPark): \App\Responses\ApiResponse
    {
        $industrialPark->update($request->validated());
        return $this->success(data: $industrialPark);
    }

    public function destroy(IndustrialPark $industrialPark): \App\Responses\ApiResponse
    {
        try {

            if ($industrialPark->delete()) {
                return $this->success('Industrial Park deleted successfully', $industrialPark);
            }

            return $this->error('Industrial Park delete failed', status:422);

        } catch (\Exception $e) {
            return $this->error('Error deleting industrial park: ' . $e->getMessage(), status: 500);
        }
    }
}
