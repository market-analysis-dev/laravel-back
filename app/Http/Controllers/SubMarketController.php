<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmarketRequest;
use App\Http\Requests\UpdateSubmarketRequest;
use App\Models\File;
use App\Models\SubMarket;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class SubMarketController extends ApiController implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:submarkets.index', only: ['index']),
            new Middleware('permission:submarkets.show', only: ['show']),
            new Middleware('permission:submarkets.create', only: ['store']),
            new Middleware('permission:submarkets.update', only: ['update']),
            new Middleware('permission:submarkets.destroy', only: ['destroy']),
        ];
    }


    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function index(Request $request): ApiResponse
    {
        $marketId = $request->query('market_id');

        $query = SubMarket::where('status', '=', 'active');

        if ($marketId) {
            $query->where('market_id', '=', $marketId);
        }

        $subMarkets = $query->get();

        return $this->success(data: $subMarkets);
    }

    public function show(Submarket $submarket): ApiResponse
    {
        return $this->success(data: $submarket);
    }

    public function store(StoreSubmarketRequest $request): ApiResponse
    {
        $data = $request->validated();
        $submarket = Submarket::create($data);

        return $this->success('Submarket created successfully', $submarket);

    }

    public function update(UpdateSubmarketRequest $request, Submarket $submarket): ApiResponse
    {
        $data = $request->validated();
        $submarket->update($data);
        return $this->success('Submarket updated successfully', $submarket);
    }

    public function destroy(Submarket $submarket): ApiResponse
    {
        $submarket->delete();
        return $this->success('Submarket deleted successfully', data: $submarket);

    }
}
