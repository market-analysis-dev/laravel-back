<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterMarketSizeRequest;
use App\Responses\ApiResponse;
use App\Services\MarketSizeService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarketSizeController extends ApiController implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:market-size.index', only: ['index'])
        ];
    }

    public function __construct(private readonly MarketSizeService $buildingService)
    {
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(FilterMarketSizeRequest $request): ApiResponse
    {
        $buildings = $this->buildingService->filter($request->validated());
        return $this->success(data: $buildings);
    }
}
