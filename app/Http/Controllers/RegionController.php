<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Responses\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends ApiController
{
    public static function middleware()
    {
        return [
            new Middleware('permission:regions.index', only: ['index']),
            new Middleware('permission:regions.show', only: ['show']),
            new Middleware('permission:regions.create', only: ['store']),
            new Middleware('permission:regions.update', only: ['update']),
            new Middleware('permission:regions.destroy', only: ['destroy']),
        ];
    }

    public function index(): ApiResponse
    {
        return $this->success(data: Region::all());
    }

    public function store(StoreRegionRequest $request)
    {
        $region = Region::create($request->validated());
        return $this->success('Region created successfully', $region);
    }

    public function show(Region $region)
    {
        return $this->success(data: $region);
    }

    public function update(UpdateRegionRequest $request, Region $region)
    {
        try {
            if ($region->update($request->validated())) {
                return $this->success('Region updated successfully', $region);
            }

            return $this->error('Region update failed', status:422);
            
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }

    public function destroy(Region $region)
    {
        try {
            if ($region->delete()) {
                return $this->success('Region deleted successfully', $region);
            }
            return $this->error('Region delete failed', status:422);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }
}