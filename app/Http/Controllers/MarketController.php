<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarketRequest;
use App\Http\Requests\UpdateMarketRequest;
use App\Models\Market;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarketController extends ApiController implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:markets.index', only: ['index']),
            new Middleware('permission:markets.show', only: ['show']),
            new Middleware('permission:markets.create', only: ['store']),
            new Middleware('permission:markets.update', only: ['update']),
            new Middleware('permission:markets.destroy', only: ['destroy']),
        ];
    }


    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function index(Request $request): ApiResponse
    {
        $query = Market::query();

        if ($request->has('region_id')) {
            $query->where('region_id', $request->input('region_id'));
        }
        $query->where('status', '=', 'active');
        $markets = $query->get();

        return $this->success(data: $markets);
    }

    /**
     * @param StoreMarketRequest $request
     * @return ApiResponse
     */
    public function store(StoreMarketRequest $request): ApiResponse
    {
        $market = Market::create($request->validated());
        return $this->success('Market created successfully', $market);
    }

    /**
     * @param Market $market
     * @return ApiResponse
     */
    public function show(Market $market): ApiResponse
    {
        return $this->success(data: $market);
    }

    /**
     * @param UpdateMarketRequest $request
     * @param Market $market
     * @return ApiResponse
     */
    public function update(UpdateMarketRequest $request, Market $market): ApiResponse
    {
        try {
            if ($market->update($request->validated())) {
                return $this->success('Market updated successfully', $market);
            }

            return $this->error('Marketr update failed', status:422);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }

    /**
     * @param Market $market
     * @return ApiResponse
     */
    public function destroy(Market $market): ApiResponse
    {
        try {
            if ($market->delete()) {
                return $this->success('Market deleted successfully', $market);
            }
            return $this->error('Market delete failed', status:422);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }
}
