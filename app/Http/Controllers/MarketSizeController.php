<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexBuildingRequest;
use App\Responses\ApiResponse;
use App\Services\BuildingService;
use App\Services\FileService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarketSizeController extends ApiController implements HasMiddleware
{
    private BuildingService $buildingService;

    public static function middleware(): array
    {
        return [
            new Middleware('permission:market-size.index', only: ['index']),
            new Middleware('permission:market-size.update', only: ['update']),
        ];
    }

    public function __construct(BuildingService $buildingService, FileService $fileService)
    {
        $this->buildingService = $buildingService;
        $this->fileService = $fileService;
    }

    public function index(IndexBuildingRequest $request): ApiResponse
    {
        $buildings = $this->buildingService->filter($request->validated());
        return $this->success(data: $buildings);
    }
}
