<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexBuildingRequest;
use App\Http\Resources\MarketSizeResource;
use App\Models\Building;
use App\Responses\ApiResponse;
use App\Services\MarketSizeService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarketSizeController extends ApiController implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:market-size.index', only: ['index','listAvl']),
        ];
    }

    public function __construct(private readonly MarketSizeService $marketSizeService)
    {
    }

    public function index(IndexBuildingRequest $request): ApiResponse
    {
        $buildings = $this->marketSizeService->filter($request->validated());
        return $this->success(
            data: MarketSizeResource::collection($buildings),
            extraData: [
                'meta' => [
                    'total' => $buildings->total(),
                    'per_page' => $buildings->perPage(),
                    'current_page' => $buildings->currentPage(),
                    'last_page' => $buildings->lastPage(),
                ],
                'links' => [
                    'first' => $buildings->url(1),
                    'last' => $buildings->url($buildings->lastPage()),
                    'prev' => $buildings->previousPageUrl(),
                    'next' => $buildings->nextPageUrl(),
                ],
            ]);
    }

    public function listAvl(Building $building): ApiResponse
    {
        $buildingsAvailable = $building->buildingsAvailable;

        return $this->success(data: $buildingsAvailable);

    }
}
