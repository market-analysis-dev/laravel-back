<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustrialParkRequest;
use App\Http\Requests\UpdateIndustrialParkRequest;
use App\Models\IndustrialPark;

class IndustrialParkController extends ApiController
{
    public function index(): \App\Responses\ApiResponse
    {
        return $this->success(data: IndustrialPark::all());
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

            return $this->error('Industrial Park delete failed', 422);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
