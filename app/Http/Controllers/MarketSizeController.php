<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexBuildingRequest;
use App\Http\Resources\MarketResource;
use App\Responses\ApiResponse;
use App\Services\MarketSizeService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarketSizeController extends ApiController implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:market-size.index', only: ['index']),
        ];
    }

    public function __construct(private readonly MarketSizeService $marketSizeService)
    {
    }

    public function index(IndexBuildingRequest $request): ApiResponse
    {
        $buildings = $this->marketSizeService->filter($request->validated());
        return $this->success(data: MarketResource::collection($buildings));
    }
}
