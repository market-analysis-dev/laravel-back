<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexClientBuildingAvailabilityRequest;
use App\Http\Resources\ClientBuildingAvailabilityResource;
use App\Http\Resources\ClientBuildingAvailabilityStatisticResource;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use App\Services\ClientBuildingAvailabilityService;

class ClientController extends ApiController
{
    public function buildingAvailabilityList(IndexClientBuildingAvailabilityRequest $request, ClientBuildingAvailabilityService $service): ApiResponse
    {
        $validated = $request->validated();

        $availabilities = $service->filter($validated);
        return $this->success(
            data: ClientBuildingAvailabilityResource::collection($availabilities)
        );
    }

    public function buildingAvailabilityStatistic(IndexClientBuildingAvailabilityRequest $request, ClientBuildingAvailabilityService $service): ApiResponse
    {
        $validated = $request->validated();
        $availabilities = $service->filterStatistic($validated);
        //return $this->success(data:$availabilities);
        return $this->success(
            data: ClientBuildingAvailabilityStatisticResource::make($availabilities)
        );
    }
}
